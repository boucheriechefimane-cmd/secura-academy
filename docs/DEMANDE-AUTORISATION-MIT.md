# Lettre à MIT OpenCourseWare / MIT Learn — demande d'autorisation de réutilisation

**Statut :** projet prêt à envoyer. L'envoi demande l'accord explicite du
propriétaire.
**Objet :** réutilisation des quiz d'examen du MIT 6.858 dans une plateforme
d'apprentissage cyber (gratuit pour l'élève, puis éventuellement service payant).

---

## Pourquoi cette lettre

Les 132 questions que la plateforme importe aujourd'hui viennent des quiz
d'examen du MIT 6.858 (*Computer Systems Security*, Fall 2014) — 17 QCM et
**115 problèmes d'examen rédigés, avec les corrigés officiels du MIT**. La
licence du cours est **CC BY-NC-SA 4.0** : réutilisation libre avec
attribution, mais **usage non commercial**.

Conséquence : la plateforme peut être **gratuite** (c'est le cas aujourd'hui),
mais elle ne peut pas **vendre** l'accès à ce contenu sans autorisation
supplémentaire. C'est la seule chose qui manque pour proposer un service
payant.

## Ce que la plateforme propose (en échange)

- **Attribution complète** : chaque question porte la source, le cours, l'année
  et la licence ; la mention « Partage dans les mêmes conditions » est
  affichée à l'élève.
- **ShareAlike** : le contenu importé est redistribué sous CC BY-NC-SA 4.0.
- **Pas de revente du contenu** : les questions ne sont pas vendues à l'unité ;
  ce qui serait payant, c'est l'accompagnement (parcours, attestation
  individuelle, coaching, environnement de laboratoire).
- **Traçabilité** : l'import est automatique, vérifié et audité à chaque
  version (registre `docs/SOURCES-CONTENU.md`, outil `tools/import-questions.py`,
  test `tests/import-test.py`).

## Les questions à poser

1. MIT OpenCourseWare accorde-t-il une **autorisation de réutilisation
   commerciale** des quiz d'examen 6.858 (et, le cas échéant, 6.1600) en
   dehors du cadre CC BY-NC-SA ?
2. Sous quelles conditions (mention à porter, clause de non-endorsement,
   engagement sur la monétisation, formation des auteurs) ?
3. Y a-t-il un programme d'accompagnement type **MIT Learn / Open Learning**
   pour un projet à accès gratuit et multilingue ?
4. Les **corrigés officiels** peuvent-ils être affichés à l'élève comme
   « correction officielle du MIT » (comme aujourd'hui) ?
5. Un contact direct (professeurs du 6.858, équipe OCW, MIT Learn) est-il
   possible ?

## Version courte (e-mail, 200 mots)

> **Objet :** réutilisation des quiz d'examen du MIT 6.858 dans une plateforme
> d'apprentissage cyber
>
> Bonjour,
>
> Nous avons construit une plateforme d'apprentissage en cybersécurité, gratuite
> pour les élèves, disponible en français, arabe et anglais
> (github.com/boucheriechefimane-cmd/secura-academy). Nous avons importé les
> quiz d'examen et les corrigés officiels du cours 6.858 *Computer Systems
> Security* (Fall 2014), avec attribution complète et redistribution sous
> CC BY-NC-SA 4.0, comme le prévoient les conditions du cours.
>
> Deux questions :
> - la plateforme peut-elle rester gratuite, ou devenir payante ?
> - existe-t-il une autorisation d'usage commercial, et à quelles conditions ?
>
> Pouvez-vous nous indiquer les conditions d'une utilisation en dehors du
> cadre non commercial, ou nous orienter vers le bon interlocuteur ?
>
> Bien cordialement,
> [nom] — [projet]

---

## Ce qui change pour la plateforme selon la réponse

| Réponse du MIT | Effet |
|---|---|
| **Accord commercial** | Le contenu MIT (et 6.1600) devient utilisable dans un service payant ; c'est la voie la plus rentable en volume et en crédibilité. |
| **Refus** | La plateforme reste gratuite (décision par défaut) ; l'import NC reste interdit pour un usage payant — le garde-fou est déjà dans l'outil. |
| **Silence** | Même règle : gratuit, et on cherche d'autres sources libres **sans** « NC » (OWASP CC BY-SA, NIST domaine public) ou on achète une banque de questions avec droit de rediffusion. |

Dans tous les cas, **rien n'est bloqué** : le code est prêt, le catalogue est
classé source par source, et l'outil refuse automatiquement ce qui n'est pas
autorisé.
