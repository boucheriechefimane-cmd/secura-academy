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
| `6-006-introduction-to-algorithms-spring-2008` | `final_soln`, `solutions1`, `solutions2` | **Format couvert en principe** : les items portent « Solution: » et l'enonce est en « N. Titre » + sous-items. A tryer avec `--format problem-parties`. |
| `6-006-introduction-to-algorithms-spring-2020` | `mit6_006s20_final_sol`, `mit6_006s20_q1_sol`, `mit6_006s20_q2_sol`, `mit6_006s20_q3_sol_pdf`, `mit6_006s20_review1_sol`, `mit6_006s20_review2_sol` … (7) | Deja importe (57 questions). |
| `6-01sc-introduction-to-electrical-engineering-and-computer-science-i-spring-2011` | `mit6_01scs11_final_f09_sol`, `mit6_01scs11_final_f10_sol`, `mit6_01scs11_final_s09_sol`, `mit6_01scs11_final_s10_sol`, `mit6_01scs11_final_s11_sol`, `mit6_01scs11_mid01_f09_sol` … (13) | **PDF scannes** : refus, sauf OCR. |
| `6-034-artificial-intelligence-spring-2005` | `q1_soln`, `q2_soln`, `quiz1_review_sol`, `quiz2_review_sol` | **Partiellement couvert** : les questions qui dependent d'un arbre dessine (« the tree shown below ») sont refusees par la regle existante — c'est voulu. |
| `6-046j-design-and-analysis-of-algorithms-spring-2012` | `mit6_046js12_final_prac2011_sol`, `mit6_046js12_final_prac_sol`, `mit6_046js12_final_sol`, `mit6_046js12_quiz1_sol`, `mit6_046js12_quiz2_sol`, `mit6_046js12_quiz2prac_sol` | **PDF scannes** : refus, sauf OCR. |
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

- **PDF sans couche texte** (6.01SC, 6.046J Spring 2012, 6.006 Fall 2011) :
  l'enonce et la reponse sont dans l'image. Sans OCR, on ne peut pas les lire
  — donc on ne les invente pas.
- **Reponses en art ASCII ou en schemas** (6.090, 6.034 « the tree shown
  below ») : le corrige est un dessin, la reponse n'est pas du texte.
- **Formules abimees par l'extraction** (6.824) : la reponse officielle
  contient des fractions que `pdftotext` restitue de travers. Une reponse
  deformee est pire qu'une question absente.

## 4. La suite

1. ~~**Ecrire l'extracteur « enonce repete »**~~ — **fait** : il est ecrit
   (`tools/import-mit-enonce-repete.py`), le MIT 6.189 est importe (3
   questions), et il peut servir sur d'autres cours qui repètent
   l'enonce.
2. **Tenter le MIT 6.006 Spring 2008** avec `--format problem-parties` : le
   format « N. Titre » + sous-items + « Solution: » est proche de celui du
   MIT 6.006 Spring 2020, deja importe.
3. **Continuer au-dela du MIT** : Harvard (CS50 est sans solutions → refuse ;
   d'autres cours Harvard restent a verifier), puis Stanford, Berkeley, CMU,
   et les certifications gratuites (Fortinet NSE, Cisco Networking Basics,
   IBM SkillsBuild) dont les questions sont publiques.

Chaque vague suit la meme regle : **rien n'est reecrit, rien n'est devine,
chaque reponse vient du corrige officiel de l'universite**, avec l'attribution
et la licence dans le catalogue (`tools/sources-autorisees.json`).

