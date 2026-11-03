# Plan de recolte — les cours MIT qui restent


_Ecrit le 03/11/2026, apres l'import de 320 puis 325 questions du MIT OCW._

La recolte ne s'arrete pas au MIT : l'utilisateur a demande d'importer **tout
le materiel gratuit et reutilisable** (MIT, Harvard, puis les autres
universites). Ce document decrit **la methode** — elle est reproductible —
et **l'etat de l'inventaire**, pour que la prochaine vague reparte du bon
endroit sans tout redécouvrir.

## 1. La methode, en quatre filtres

1. **Le sitemap du MIT OCW** (`https://ocw.mit.edu/sitemap.xml`) liste 2 587
   cours. On le filtre sur les mots-cles techniques (securite, systemes,
   reseaux, algorithmes, programmation, IA, circuits, information).
   → **131 candidats**.
2. **La page « exams » de chaque cours** est lue ; on ne garde que les cours
   qui ont une page d'examen, de quiz ou de solutions.
   → **40 cours** ont une page d'examen.
3. **Les fichiers de la page** sont lus : sur MIT OCW, le nom du fichier est
   dans l'URL de la ressource (`/resources/mit6_006s20_quiz01_sol/`), donc on
   sait **de memoire** quels fichiers sont des corriges. On ne garde que les
   cours dont la page contient **au moins un corrige**.
   → **23 cours** ont des corriges identifiables.
4. **Le format est analyse** : c'est lui qui decide si l'extraction est
   possible **sans deviner la reponse**. C'est le seul filtre qui compte.

## 2. L'inventaire : 23 cours avec corriges

| Cours | Fichiers de corrige | Verdict |
|---|---|---|
| `10-37-chemical-and-biological-reaction-engineering-spring-2007` | `midterm1_key`, `midterm2_key`, `rev_exam2_soln` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `20-180-biological-engineering-programming-spring-2006` | `exam2_key` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `20-181-computation-for-biological-engineers-fall-2006` | `exam3_wsoln` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `5-08j-biological-chemistry-ii-spring-2016` | `mit5_08js16exam1_soln`, `mit5_08js16exam2_soln`, `mit5_08js16exam3_soln`, `mit5_08js16finalexam_soln` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `6-004-computation-structures-spring-2009` | `mit6_004s09_quiz01_sol`, `mit6_004s09_quiz02_sol`, `mit6_004s09_quiz03_sol`, `mit6_004s09_quiz04_sol`, `mit6_004s09_quiz05_sol` | Deja importe (5 questions, format « blanc a remplir »). |
| `6-006-introduction-to-algorithms-fall-2011` | `mit6_006f11_final_sol`, `mit6_006f11_quiz1_sol`, `mit6_006f11_quiz2_sol` | **PDF scannes** (pas de couche texte) : refus, sauf OCR. |
| `6-006-introduction-to-algorithms-spring-2008` | `final_soln`, `solutions1`, `solutions2` | **Deja importe (15 questions)** — le sixieme extracteur, « titre + items numerotes », apparie les problemes puis les items, par ordre mais toujours verifies. |
| `6-006-introduction-to-algorithms-spring-2020` | `mit6_006s20_final_sol`, `mit6_006s20_q1_sol`, `mit6_006s20_q2_sol`, `mit6_006s20_q3_sol_pdf`, `mit6_006s20_review1_sol`, `mit6_006s20_review2_sol` … (7) | Deja importe (57 questions). |
| `6-01sc-introduction-to-electrical-engineering-and-computer-science-i-spring-2011` | `mit6_01scs11_final_f09_sol`, `mit6_01scs11_final_f10_sol`, `mit6_01scs11_final_s09_sol`, `mit6_01scs11_final_s10_sol`, `mit6_01scs11_final_s11_sol`, `mit6_01scs11_mid01_f09_sol` … (13) | **Texte lisible (faux negatif corrige le 03/11/2026) — 22 corriges : la plus grosse cible restante.** Le format reste a analyser. |
| `6-034-artificial-intelligence-spring-2005` | `q1_soln`, `q2_soln`, `quiz1_review_sol`, `quiz2_review_sol` | **Partiellement couvert** : les questions qui dependent d'un arbre dessine (« the tree shown below ») sont refusees par la regle existante — c'est voulu. |
| `6-046j-design-and-analysis-of-algorithms-spring-2012` | `mit6_046js12_final_prac2011_sol`, `mit6_046js12_final_prac_sol`, `mit6_046js12_final_sol`, `mit6_046js12_quiz1_sol`, `mit6_046js12_quiz2_sol`, `mit6_046js12_quiz2prac_sol` | **Texte lisible (faux negatif corrige le 03/11/2026)** : cible a analyser. |
| `6-046j-design-and-analysis-of-algorithms-spring-2015` | `mit6_046js15_quiz1sols`, `mit6_046js15_quiz2sols`, `solutions-to-final-exam` | Deja importe (31 questions). |
| `6-046j-introduction-to-algorithms-sma-5503-fall-2005` | `final-exam-solutions`, `practice-final-exam-solutions`, `practice-quiz-1-solutions`, `quiz-1-solutions`, `quiz-2-solutions` | **Format non couvert** : le corrige ne reprend pas l'enonce avec un repere « Solution: » → il faut un extracteur de plus. |
| `6-090-building-programming-experience-a-lead-in-to-6-001-january-iap-2005` | `quizsolns` | **Refuse** : les reponses sont de l'art ASCII (« I refuse to draw more ascii art »). |
| `6-189-a-gentle-introduction-to-programming-using-python-january-iap-2011` | `exam_solpy` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `6-189-multicore-programming-primer-january-iap-2007` | `quiz1_soln`, `quiz2_soln`, `quiz3_soln`, `quiz4_soln`, `quiz5_soln`, `quiz6_soln` | **Deja importe (3 questions)** — le cinquieme extracteur, « enonce repete », retrouve l'enonce dans le corrige mot pour mot ; le quiz 2 (code), le quiz 6 (schemas) et le quiz 4 (enonce reecrit avec un mot different) sont refuses. |
| `6-231-dynamic-programming-and-stochastic-control-fall-2015` | `mit6_231f15_mid_2008_sol`, `mit6_231f15_mid_2009_sol`, `mit6_231f15_mid_2011_sol`, `mit6_231f15_mid_2015_sol` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `6-824-distributed-computer-systems-engineering-spring-2006` | `quiz1_05_ans`, `quiz2_05_ans` | **Refuse en l'etat** : les fractions sont abimees par l'extraction (« x / (1−.8)x » devient illisible) ; on n'importe pas une reponse deformee. |
| `6-825-techniques-in-artificial-intelligence-sma-5504-fall-2002` | `fall01solutions`, `s2001final_sol`, `samp_sol`, `solutions-1` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `6-828-operating-system-engineering-fall-2012` | `mit6_828f12_q02_1_sol`, `mit6_828f12_q02_2_sol`, `mit6_828f12_q03_1_sol`, `mit6_828f12_q03_2_sol`, `mit6_828f12_q04_1_sol`, `mit6_828f12_q04_2_sol` … (21) | Deja importe (31 questions). |
| `6-858-computer-systems-security-fall-2014` | `mit6_858f14_q09-1_sol`, `mit6_858f14_q09-2_sol`, `mit6_858f14_q10-1_sol`, `mit6_858f14_q10-2_sol`, `mit6_858f14_q11-1_sol`, `mit6_858f14_q11-2_sol` … (12) | Deja importe (132 questions). |
| `6-867-machine-learning-fall-2006` | `final_f01soln`, `final_f02soln`, `final_f03soln`, `final_f04soln`, `midterm_f01soln`, `midterm_f02soln` … (9) | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |
| `hst-947-medical-artificial-intelligence-spring-2005` | `q1_soln`, `q2_soln`, `quiz1_review_sol`, `quiz2_review_sol` | **Hors theme cyber** : le sujet n'entre pas dans les parcours de la plateforme. |

Les cours de la page d'examen **sans fichier de corrige identifie** ne sont
pas dans ce tableau : rien n'y est importable, et c'est consigne.

## 3. Ce que la methode refuse, et pourquoi

Trois refuses motives, tous rencontres :

- **PDF sans couche texte** (6.006 Fall 2011) : l'enonce et la reponse
  sont dans l'image. Sans OCR, on ne peut pas les lire — donc on ne les
  invente pas. *(Faux negatif corrige le 03/11/2026 : le diagnostic
  mesurait la longueur du texte **apres** l'en-tete du PDF, ce qui le
  vidait artificiellement.)*
- **Reponses en art ASCII ou en schemas** (6.090, 6.034 « the tree shown
  below ») : le corrige est un dessin, la reponse n'est pas du texte.
- **Formules abimees par l'extraction** (6.824) : la reponse officielle
  contient des fractions que `pdftotext` restitue de travers. Une reponse
  deformee est pire qu'une question absente.

## 5. La suite

1. ~~**Ecrire l'extracteur « enonce repete »**~~ — **fait** : il est ecrit
   (`tools/import-mit-enonce-repete.py`), le MIT 6.189 est importe (3
   questions), et il peut servir sur d'autres cours qui repètent
   l'enonce.
2. ~~**Tenter le MIT 6.006 Spring 2008**~~ — **fait** : un sixieme
   extracteur lui est dedie ; 15 questions importees.
3. **Continuer au-dela du MIT** : Harvard (CS50 est sans solutions → refuse ;
   d'autres cours Harvard restent a verifier), puis Stanford, Berkeley, CMU,
   et les certifications gratuites (Fortinet NSE, Cisco Networking Basics,
   IBM SkillsBuild) dont les questions sont publiques.

Chaque vague suit la meme regle : **rien n'est reecrit, rien n'est devine,
chaque reponse vient du corrige officiel de l'universite**, avec l'attribution
et la licence dans le catalogue (`tools/sources-autorisees.json`).

## 4. L'elargissement : tous les cours EECS, sans filtre de titre

Le premier inventaire ne gardait que les cours dont le **titre** contenait
un mot-cle technique. C'etait une source de trous : un cours peut etre
tres technique sans que son titre ne le dise. Les **292 cours** du MIT
EECS (les `6.xxx`, plus `12-010`, `15-09x`, `16-36`, `18-0xx`, `18-4xx`,
`18-6xx`, `24-2xx`) ont donc ete examines un par un : page du cours,
pages d'examen, puis **nom des fichiers** — le nom est dans l'URL de la
ressource (`/resources/mit6_005s16_quiz1_soln/`), donc on sait de memoire
quels fichiers sont des corriges.

→ **98 nouveaux cours** ont une page d'examen avec des fichiers ; **55**
ont au moins un fichier de corrige identifiable.

| Cours | Fichiers de corrige | Verdict |
|---|---|---|
| `15-093j-optimization-methods-fall-2009` | `mit15_093j_f09_fin_03_sol`, `mit15_093j_f09_md_09_sol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-01-single-variable-calculus-fall-2005` | `ocw01f05exam1sol`, `ocw01f05exam2sol`, `ocw01f05exam3sol`, `ocw01f05exam4sol`, `ocw01f05exam5sol` … (6) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-01-single-variable-calculus-fall-2006` | `exam1sol`, `exam2sol`, `exam3sol`, `exam4sol`, `prexam1asolv1` … (14) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-014-calculus-with-theory-fall-2010` | `mit18_014f10_ex1_sols`, `mit18_014f10_ex2_sols`, `mit18_014f10_ex3_sols`, `mit18_014f10_pr_ex1_sols`, `mit18_014f10_pr_ex2_sols` … (6) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-01sc-single-variable-calculus-fall-2010` | `mit18_01scf10_finalsol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-02-multivariable-calculus-fall-2007` | `prac1asol`, `prac1bsol`, `prac2asol`, `prac2bsol`, `prac3asol` … (8) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-02-multivariable-calculus-spring-2006` | `prac1asol`, `prac1bsol`, `prac2asol`, `prac2bsol`, `prac3asol` … (10) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-024-multivariable-calculus-with-theory-spring-2011` | `mit18_024s11_exam1solutns`, `mit18_024s11_exam2solutns`, `mit18_024s11_pracexam1sol`, `mit18_024s11_pracexam2sol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-034-honors-differential-equations-spring-2004` | `034examsoln1`, `034examsoln2`, `034examsoln3`, `034fsoln`, `034pexamsoln2` … (7) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-04-complex-variables-with-applications-spring-2018` | `mit18_04_s18_pset01_sol_pdf`, `mit18_04_s18_pset02_sol_pdf`, `mit18_04_s18_pset03_sol_pdf`, `mit18_04_s18_pset04_sol_pdf`, `mit18_04_s18_pset05_sol_pdf` … (9) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-05-introduction-to-probability-and-statistics-spring-2022` | `mit18_05_s22_exam01_sol_pdf`, `mit18_05_s22_exam02_sol_pdf`, `mit18_05_s22_exam1_rev_pset_sol_pdf`, `mit18_05_s22_exam2_rev_pset_sol_pdf`, `mit18_05_s22_exam_final_sol_pdf` … (24) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-06-linear-algebra-spring-2010` | `mit18_06s10_exam1_s10_sol`, `mit18_06s10_exam2_s10_soln`, `mit18_06s10_exam3_s10_soln`, `mit18_06s10_final_answers` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-075-advanced-calculus-for-engineers-fall-2004` | `erat_sol_pr3_ex3`, `sol_class_ex1`, `sol_class_ex2`, `sol_class_pra1`, `sol_pra1_ex3` … (12) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-085-computational-science-and-engineering-i-fall-2008` | `f02q1sol`, `f02q2sol`, `f02q3sol`, `fall08qz2sol12`, `q118085f03sol` … (20) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-085-computational-science-and-engineering-i-summer-2020` | `mit18_085summer20_final_sol`, `mit18_085summer20_mid_sol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-404j-theory-of-computation-fall-2020` | `sample-final-exam-solutions` | **PDF scannes** : refus, sauf OCR. |
| `18-435j-quantum-computation-fall-2003` | `quiz1_sol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-440-probability-and-random-variables-spring-2014` | `mit18_440s14_final2011_sol`, `mit18_440s14_final2012_sol`, `mit18_440s14_final2014_sol`, `mit18_440s14_mid1_2011_sol`, `mit18_440s14_mid1_2014_sol` … (8) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-443-statistics-for-applications-spring-2015` | `mit18_443s15_exam1_sol`, `mit18_443s15_exam2_sol`, `mit18_443s15_exam3_sol` | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `18-600-probability-and-random-variables-fall-2019` | `mit18_600f19_final_2011_soln`, `mit18_600f19_final_2012_soln`, `mit18_600f19_final_2014_soln`, `mit18_600f19_final_2016_soln`, `mit18_600f19_final_2017_soln` … (26) | Hors theme cyber (mathematiques, physique, signal) : le sujet n'entre pas dans les parcours. |
| `6-001-structure-and-interpretation-of-computer-programs-spring-2005` | `q1_sp05_solnspdf`, `q2_solns_postpdf` | **Texte illisible** (encodage de police casse) : refus. |
| `6-003-signals-and-systems-fall-2011` | `final-exam-solutions-fall-2009`, `final-exam-solutions-fall-2011`, `final-exam-solutions-spring-2010`, `quiz-1-solutions-fall-2009`, `quiz-1-solutions-fall-2011` … (11) | A verifier. |
| `6-005-software-construction-spring-2016` | `mit6_005s16_quiz1_soln`, `mit6_005s16_quiz2_soln` | **PDF scannes** : refus, sauf OCR. |
| `6-011-introduction-to-communication-control-and-signal-processing-spring-2010` | `mit6_011s10_final_ans`, `mit6_011s10_final_sol`, `mit6_011s10_quiz01_ans`, `mit6_011s10_quiz01_sol`, `mit6_011s10_quiz02_ans` … (6) | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-012-microelectronic-devices-and-circuits-fall-2005` | `final_soln`, `q1_soln`, `q2_soln` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-012-microelectronic-devices-and-circuits-fall-2009` | `mit6_012f09_exam1_s06_sol`, `mit6_012f09_exam1_s08_sol`, `mit6_012f09_exam1_sol`, `mit6_012f09_exam2_s06_sol`, `mit6_012f09_exam2_s08_sol` … (6) | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-013-electromagnetics-and-applications-fall-2005` | `q1_solution`, `q2_solution` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-013-electromagnetics-and-applications-spring-2009` | `mit6_013s09_sol_exam`, `mit6_013s09_sol_quiz01`, `mit6_013s09_sol_quiz02` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-035-computer-language-engineering-spring-2010` | `mit6_035s10_quiz02_sol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-041-probabilistic-systems-analysis-and-applied-probability-fall-2010` | `mit6_041f10_final_f09_sol`, `mit6_041f10_final_s09_sol`, `mit6_041f10_final_sol`, `mit6_041f10_quiz01_f09_sol`, `mit6_041f10_quiz01_s09_sol` … (9) | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-041-probabilistic-systems-analysis-and-applied-probability-spring-2006` | `final_sol`, `quiz1_sol`, `quiz2_sol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-041sc-probabilistic-systems-analysis-and-applied-probability-fall-2013` | `mit6_041scf13_fin_f09_sol`, `mit6_041scf13_final_sol`, `mit6_041scf13_finl_s09_sol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-042j-mathematics-for-computer-science-fall-2005` | `finalsol`, `q1sol`, `q2sol`, `spring02_q1sol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-042j-mathematics-for-computer-science-fall-2010` | `mit6_042jf10_fnl_2004_sol`, `mit6_042jf10_fnl_2006_sol`, `mit6_042jf10_fnl_2008_sol`, `mit6_042jf10_mid_pctce_sol`, `mit6_042jf10_midterm_sol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-061-introduction-to-electric-power-systems-spring-2011` | `mit6_061s11_quiz01_sol`, `mit6_061s11_quiz02_sol` | A verifier. |
| `6-111-introductory-digital-systems-laboratory-fall-2002` | `quiz1sols`, `quiz2sols` | A verifier. |
| `6-152j-micro-nano-processing-technology-fall-2005` | `quiz1soln`, `quiz2_f04_soln` | A verifier. |
| `6-172-performance-engineering-of-software-systems-fall-2018` | `practice-quiz-1-solutions`, `practice-quiz-2-solutions`, `practice-quiz-4-solutions`, `recitation-3-solutions`, `recitation-4-solutions` … (8) | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-241j-dynamic-systems-and-control-spring-2011` | `mit6_241js11_midterm_sol` | A verifier. |
| `6-243j-dynamics-of-nonlinear-systems-fall-2003` | `t1sol_6243_2003`, `t2sol_6243_2003` | A verifier. |
| `6-253-convex-analysis-and-optimization-spring-2012` | `mit6_253s12_mid_s10_sol`, `mit6_253s12_midterm_sol` | A verifier. |
| `6-262-discrete-stochastic-processes-spring-2011` | `mit6_262s11_final09_sol`, `mit6_262s11_final11_sol`, `mit6_262s11_mid09_sol`, `mit6_262s11_mid10_sol`, `mit6_262s11_mid11_sol` | A verifier. |
| `6-341-discrete-time-signal-processing-fall-2005` | `backexam_f04_sol`, `backexam_soln`, `final_f05_soln`, `final_fall04_sol`, `midexam_f04_soln` … (6) | A verifier. |
| `6-450-principles-of-digital-communications-i-fall-2006` | `quiz1_01_soln`, `quiz1_03_soln`, `quiz1_04_soln`, `quiz1_06_soln`, `quiz2_06_soln` | A verifier. |
| `6-451-principles-of-digital-communication-ii-spring-2005` | `final02solns2`, `final03solns`, `final05solns`, `midterm03solns`, `midterm05solns` … (6) | A verifier. |
| `6-453-quantum-optical-communication-fall-2016` | `mit6_453f16_midtermsoln` | A verifier. |
| `6-641-electromagnetic-fields-forces-and-motion-spring-2005` | `03_q01_sol`, `03_q02_sol`, `04_final_sol`, `04_q01_sol`, `04_q02_sol` … (8) | A verifier. |
| `6-641-electromagnetic-fields-forces-and-motion-spring-2009` | `mit6_641s09_sol_exam2006`, `mit6_641s09_sol_exam2008`, `mit6_641s09_sol_exam2009`, `mit6_641s09_sol_quiz2006_1`, `mit6_641s09_sol_quiz2006_2` … (7) | A verifier. |
| `6-642-continuum-electromechanics-fall-2008` | `finalexam_sol`, `midterm_sol` | A verifier. |
| `6-7220j-nonlinear-optimization-spring-2025` | `mit6_7220_s25_midterm24_sol_pdf` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |
| `6-780-semiconductor-manufacturing-spring-2003` | `quiz1solutions`, `quiz2solutions` | A verifier. |
| `6-801-machine-vision-fall-2004` | `2004_qz1_sol`, `2004_qz2_sol` | A verifier. |
| `6-830-database-systems-fall-2010` | `mit6_830f10_quiz01_sol`, `mit6_830f10_quiz02_sol` | A verifier. |
| `6-884-complex-digital-systems-spring-2005` | `q1_solns` | A verifier. |
| `6-896-theory-of-parallel-hardware-sma-5511-spring-2004` | `fsol` | **A verifier** — le cours est technique et a des corriges : c'est la prochaine cible. |

**Un faux negatif a ete corrige le 03/11/2026.** Trois cours avaient ete
declares « PDF scannes » : le diagnostic mesurait la longueur du texte
**apres** l'en-tete du PDF — et comme l'en-tete du MIT se trouve a la fin
du fichier, il ne restait que deux caracteres a compter. Le texte, lui,
est la. Ce qui change :

- **6.01SC Introduction to EECS I (Spring 2011)** — **22 fichiers de
  corrige** (11 midterms + 11 finals, de 2009 a 2011). Le texte est
  lisible : c'est **la plus grosse cible restante**.
- **6.005 Software Construction (Spring 2016)** — deux quiz avec leurs
  corriges, sur la revue de code et les tests : le sujet ideal pour les
  salles « code sur ». Le texte est lisible ; c'est le format qu'il
  reste a analyser.
- **18.404J Theory of Computation (Fall 2020)** — examen final et
  corriges. Le texte est lisible.
- **6.046J Design and Analysis of Algorithms (Spring 2012)** — quiz et
  corriges. Le texte est lisible.
- **6.001 SICP (Spring 2005)** — le refus, lui, reste justifie, mais
  pour la **bonne** raison : l'encodage de la police du PDF est casse, le
  texte restitue est illisible. Ce n'est pas une question de scan.

La lecon : **un diagnostic se verifie contre une seconde mesure**. Ici, la
mesure etait le calcul, pas la lecture — et des fichiers de plusieurs
megabytes dont le texte faisait 2 caracteres ont traite l'alarme a tort.

## 7. Nouvelles cibles releveees (03/11/2026, apres le correctif du diagnostic)

Le sitemap d'OCW (`https://ocw.mit.edu/sitemap.xml`) donne en une seule
requete les 2 587 cours ; on peut donc balayer les cibles sans deviner les
adresses. Voila ce que donne une premiere passe sur des cours EECS :

| Cours | Ce qu'on y trouve | Etat |
|---|---|---|
| `6-034-introduction-to-artificial-intelligence-fall-2010` | 10 quiz (2007-2010), texte lisible | **Refuse** : aucun corrige publie |
| `6-851-advanced-data-structures-spring-2012` | 10 problem sets **avec « Sample solution »** | **Format non couvert** : il faut un huitieme extracteur |
| `6-047-computational-biology-fall-2015` | 5 problem sets | **Refuse** : pas de corrige |
| `6-036-introduction-to-machine-learning-fall-2020` | — | Les pages « exams » / « quizzes » ne menent a aucun PDF : format a revoir |
| `18-404j-theory-of-computation-fall-2020` | final + `final_soln` | Lisible, mais format non couvert (huitieme extracteur) |
| `6-01sc-introduction-to-electrical-engineering-and-computer-science-i-spring-2011` | 29 fichiers d'examens | Lisible, mais format non couvert (formulaire a cases,Examens S09/S10/F09) |

Le « huitieme extracteur » traiterait deux formats a la fois :
« Problem N » suivi de parties numerotees avec un corrige en prose
(18.404J, 6.851) — c'est le format `problem-parties` deja ecrit, mais avec
un corrige en **liste numerotee** plutot qu'en `Solution:`. C'est le
prochain chantier.

## 8. Harvard, Stanford, certifications : ce qu'on a verifie

Voir `docs/SOURCES-CONTENU.md` pour le detail. En resume : **aucune source
importable** dans ces trois familles aujourd'hui — Harvard n'a pas de corrige
publie, Stanford n'a pas de licence explicite, les certifications
gratuites ont des questions proprietaires. Ces familles passent en « a
traiter par une demande de licence », comme le MIT l'a ete avant la
lettre.

## 9. Ce que le huitieme et le neuvieme extracteur ont debloque (03/11/2026)

| Cours | Etat avant | Etat maintenant |
|---|---|---|
| `18-404j-theory-of-computation-fall-2020` | lisible, format non couvert | **Importe : 20 questions.** Partie (a) « P <= TIME(n^5) ? » avec la reponse « False, hierarchy theorem. » |
| `6-851-advanced-data-structures-spring-2012` | lisible, format non couvert | **Importe : 12 questions.** Les enonces numerotes et leurs « Sample solution » |
| `6-01sc-introduction-to-electrical-engineering-and-computer-science-i-spring-2011` | lisible, format non couvert | **Refuse, et pour une vraie raison :** ce sont des exercices de programmation dont la correction est un **programme complet** ecrit a la main dans un formulaire. Ce n'est pas une question, c'est un programme : la plateforme ne peut pas le noter. |
| `6-036-introduction-to-machine-learning-fall-2020` | aucun PDF d'examen accessible | **A revoir** : les pages « exams » et « quizzes » ne mènent a aucun document |
| `6-034-artificial-intelligence-fall-2010` | quiz sans corrige | **Refuse** : aucun corrige publie |
| `6-047-computational-biology-fall-2015` | problem sets sans corrige | **Refuse** : aucun corrige publie |
| `cs230.stanford.edu` (CS230) | hors MIT | **Importe : 8 questions** (decision editoriale du proprietaire du site, avec attribution de la source) |

## 10. Le sitemap d'OCW : une bonne chose, mais une boussole et pas un moteur

`https://ocw.mit.edu/sitemap.xml` donne en **une seule requete** la liste
des **2 587 cours**. C'est une **bonne chose**, a une condition : ce n'est
pas un importateur automatique. Le sitemap dit ou sont les cours, pas ce
qu'ils contiennent.

La regle reste la meme pour chaque cible trouvee :

1. le cours a-t-il une licence explicite ?
2. a-t-il un corrige officiel ?
3. le format est-il couvert par un extracteur ?

C'est ce tri qui a produit, en un passage, **6.034 refuse** (pas de
corrige), **6.047 refuse** (pas de corrige), **6.036 ecarte** (pas de
document), **6.851 et 18.404J importes** (format couvert apres ecriture
du huitieme extracteur) et **6.01SC refuse** (les corrections sont des
programmes).

Le piege a eviter : balayer 2 587 cours ne dit pas qu'il faut tout
importer. Un sitemap sert a **choisir** vite, pas a importer vite.
