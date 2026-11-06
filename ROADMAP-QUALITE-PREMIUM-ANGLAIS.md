# ROADMAP — Contenu de qualité premium (anglais d'abord, traduction après)

> **Statut : plan importé du ZIP, à valider.** Les chiffres et les formulations au présent
> de ce document ne prouvent pas que les labs Blue, les droits de tous les contenus
> ou les examens ont été validés. Les dossiers de labs du ZIP comprennent des copies
> de machines existantes ; voir `labs/README.md`. Les contenus et licences doivent
> être vérifiés source par source ; voir `LICENSES.md` et `docs/SOURCES-CONTENU.md`.
> Pour l'état constaté et les limites, voir `docs/AUDIT-2026-11-05-ZIP-ET-DEPOT.md`.

**Objectif :** passer du score actuel **8 / 20** à un contenu de **très bonne qualité premium** en anglais, validé par des professionnels de terrain, avant de traduire en français et en arabe.

**Règle d'or :** on ne réécrit rien soi-même. Seules les questions validées par des universités ou des examens de certification sont admises. Chaque question porte sa **source** et sa **licence**.

---

## Référentiels techniques (ce sur quoi on s'appuie)

Avant d'écrire une seule question, on ancre le contenu sur des cadres reconnus par l'industrie. Un expert en cybersécurité doit pouvoir répondre : *"sur quel référentiel tu bases ton contenu ?"*

| Référentiel | À quoi il sert chez nous | Où il apparaît |
|-------------|--------------------------|----------------|
| **MITRE ATT&CK** | Catalogue des techniques d'attaque réelles (phishing, escalade de privilèges, exfiltration, etc.) | Chaque lab et chaque question d'attaque cite l'ID MITRE (ex: T1059 pour l'interpréteur de commandes) |
| **OWASP Top 10** | Les 10 vulnérabilités web les plus critiques (injection SQL, faille de contrôle d'accès, etc.) | Les rooms web s'appuient sur l'OWASP Top 10 pour leurs exercices |
| **NIST Cybersecurity Framework** | Le cycle de sécurité : Identifier, Protéger, Détecter, Répondre, Recouvrer | Structure les parcours Blue Team (défense) et les examens |
| **ISO 27001** | Management de la sécurité de l'information | Citation pour les questions de gouvernance, politiques de sécurité, conformité |

---

## Red Team vs Blue Team — les deux faces de la cybersécurité

Un expert veut voir que l'on enseigne **l'attaque ET la défense**. Chaque parcours contient maintenant les deux côtés.

| Côté | Ce qu'on enseigne | Exemples de labs |
|------|-------------------|------------------|
| **Red Team** (attaque) | Trouver et exploiter des vulnérabilités | Buffer overflow, injection SQL, craquage de mot de passe, phishing simulé |
| **Blue Team** (défense) | Détecter, analyser et bloquer les attaques | Analyse de logs, détection d'intrusion, réponse à incident, durcissement de serveur |

**Règle :** pour chaque vulnérabilité enseignée en Red Team, il existe un exercice Blue Team correspondant (comment la détecter et s'en protéger).

---

## Mise à jour régulière du contenu

Une vulnérabilité découverte aujourd'hui est obsolète dans 6 mois. On ne publie pas et on n'oublie pas.

| Fréquence | Action | Responsable |
|-----------|--------|-------------|
| **Tous les mois** | Revoir les labs dont la vulnérabibilité sous-jacente a été corrigée (ex: nouvelle version d'un logiciel) | Équipe contenu |
| **Tous les 3 mois** | Mettre à jour les questions pour refléter les nouvelles versions de MITRE ATT&CK et OWASP Top 10 | Équipe contenu |
| **Après chaque grande faille publique** (Log4j, WannaCry, etc.) | Ajouter un module court sur la faille et comment s'en protéger | Équipe contenu + expert relecteur |
| **Une fois par an** | Révision complète du parcours avec un expert certifié | Expert externe |

---

## Validation par des professionnels certifiés

Les questions universitaires sont une base, mais un expert humain demande aussi une relecture par des professionnels de terrain.

| Étape | Qui valide | Quoi |
|-------|-----------|------|
| **1. Source** | Université / examen de certification | La question vient d'une source légitime (MIT OCW, Stanford, etc.) |
| **2. Exactitude** | Pentester certifié (OSCP, CEH, CISSP) ou analyste SOC | La réponse technique est correcte et à jour |
| **3. Pédagogie** | Formateur en cybersécurité | Le niveau (Facile / Moyen / Difficile) est adapté à l'élève |
| **4. Licence** | Équipe juridique / responsable contenu | La licence et l'attribution sont correctes |

**Critère de blocage :** une question non relue par un professionnel certifié ne peut pas passer en statut "premium".

---

## Sécurité de la plateforme elle-même

Une plateforme qui enseigne la cybersécurité doit être un exemple. Elle ne peut pas avoir elle-même des failles.

| Domaine | Mesure | Statut |
|---------|--------|--------|
| **Chiffrement** | HTTPS obligatoire partout (certificat Let's Encrypt ou équivalent) | À implémenter en production |
| **Données élèves** | Aucune donnée personnelle stockée inutilement ; les mots de passe sont hachés, jamais en clair | À auditer |
| **Protection contre les attaques** | WAF (pare-feu d'application web), protection contre les injections SQL et XSS sur la plateforme elle-même | À implémenter |
| **Isolation des labs** | Chaque lab pratique tourne dans un environnement isolé (conteneur Docker ou machine virtuelle jetable) : un élève qui casse son lab ne casse pas la plateforme | À implémenter (9 machines labs déjà prévues) |
| **Journaux d'audit** | On enregistre qui a fait quoi (connexions, soumissions d'examens) pour détecter toute anomalie | À implémenter |
| **Tests de pénétration réguliers** | Un expert tente de pirater la plateforme elle-même une fois par trimestre | À planifier |

---

## Les 6 phases de la roadmap (mise à jour)

### Phase 1 — Nettoyer la maison + ancrer sur les référentiels (Semaine 1)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| Supprimer les questions hors sujet | Retirer les 2 questions de maths (MIT 18.024) | 0 question hors cyber |
| Vérifier les licences | Chaque question importée porte sa source et sa licence (MIT CC BY-NC-SA 4.0) | 100 % des importées avec licence |
| Vérifier les rooms orphelines | Chaque lot importé tombe dans une room existante | Aucune question perdue |
| **Ancrer sur les référentiels** | Associer chaque room existante à au moins un cadre (MITRE ATT&CK, OWASP Top 10, NIST, ISO 27001) | 52 / 52 rooms référencées |
| **Red / Blue identifié** | Chaque room est étiquetée Red Team, Blue Team, ou Mixte | 100 % des rooms étiquetées |

---

### Phase 2 — Des vraies questions en anglais (Semaines 2 à 4)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| Extraire les énoncés MIT | Isoler l'énoncé de la question des corrigés bruts | 1 777 énoncés extraits |
| Transformer en QCM anglais | Question + 4 propositions + 1 bonne réponse + indice + explication | 1 777 QCM anglais format plateforme |
| Citer le référentiel | Chaque question porte son cadre (MITRE ID, OWASP catégorie, NIST domaine) | 100 % des questions avec référentiel |
| Vérifier la source | Source MIT + licence CC BY-NC-SA 4.0 conservées | Attribution complète |
| **Validation expert** | Un pentester certifié relit un échantillon de questions | 0 erreur technique bloquante |
| Ne pas inventer | Si un énoncé est illisible, on REFUSE (pas de réécriture maison) | 0 question réécrite par un non-expert |

---

### Phase 3 — Labs et pratique : Red Team et Blue Team (Semaines 5 à 7)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| Un terminal par room | 52 rooms, chacune avec un lab pratique (buffer overflow, injection SQL, craquage de mot de passe, analyse de logs, etc.) | 52 / 52 rooms avec lab |
| Red + Blue par vulnérabilité | Pour chaque faille enseignée (attaque), un exercice de détection/protection (défense) | 100 % des failles ont leur paire Red/Blue |
| 4 types de tâches | QCM, texte, drapeau/action, drapeau de code dans chaque room | Chaque room propose ≥ 2 types |
| Environnement isolé | Chaque lab tourne dans un conteneur Docker jetable | Aucun lab ne peut impacter la plateforme |
| Explications d'erreur | Feedback sur chaque mauvaise réponse | Feedback sur 100 % des questions |

---

### Phase 4 — Vidéos dans chaque cours (Semaines 8 à 10)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| 1 vidéo courte par room | 3-5 min : concept, démonstration d'attaque ou tutoriel d'outil | 52 / 52 rooms avec vidéo |
| Source honnête | Citation de la provenance si vidéo externe | Chaque vidéo avec attribution |
| Sous-titres anglais | Préparer la traduction FR/AR | Vidéos prêtes à être sous-titrées |
| Référentiel cité | La vidéo mentionne le cadre utilisé (MITRE, OWASP, NIST) | 100 % des vidéos avec référentiel |

---

### Phase 5 — Examens chronométrés, certificats et sécurité de la plateforme (Semaines 11 à 12)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| Examens chronométrés | Chaque room : examen avec minuteur (ex: 10 questions, 15 min) | 52 examens avec chronomètre |
| Copies différentes | Réservoir de 1 891 questions varient les copies | 0 deux élèves avec la même copie |
| Médaille + certificat | Fin de parcours = médaille et certificat téléchargeable | 1 certificat par parcours |
| **HTTPS partout** | Chiffrement obligatoire sur la plateforme | Certificat SSL actif |
| **Protection WAF** | Pare-feu d'application contre injections/XSS | WAF configuré |
| **Isolation labs** | Conteneurs Docker pour chaque lab pratique | Labs isolés de la plateforme |
| **Journaux d'audit** | Traçage des connexions et soumissions | Logs d'audit actifs |
| **Test de pénétration** | Expert tente de pirater la plateforme (trimestriel) | 1 test effectué, failles corrigées |

---

### Phase 6 — Traduction français et arabe (Semaines 13 et +)

| Action | Détail | Critère de succès |
|--------|--------|-------------------|
| Traduire les 392 questions maison | Déjà en français, harmoniser avec l'anglais final | 392 questions FR cohérentes |
| Traduire les 1 777 questions anglais | Vers français et arabe | 1 777 questions FR + 1 777 questions AR |
| Traduire les vidéos | Sous-titres FR et AR | 52 vidéos sous-titrées FR + AR |
| Traduire l'interface | Menus, boutons, explications d'erreur | Interface complète FR + AR |
| **Re-revalidation expert** | Un expert certifié relit les traductions techniques | 0 erreur de terme technique en FR/AR |

---

## Règles d'or à respecter pendant toute la roadmap

1. **Ne jamais réécrire soi-même** : seules les questions validées par des universités ou des examens de certification sont admises.
2. **Attribution et licence obligatoires** : chaque question importée cite sa source (cours + test) et sa licence. Absence de licence = signalée honnêtement.
3. **Pas de PortSwigger** : ni verbatim, ni transposition. Liens autorisés vers leurs labs, mais aucun import de leur contenu.
4. **Site gratuit à jamais** : le contenu reste accessible sans paiement.
5. **4 types de tâches** : QCM, texte, drapeau/action, drapeau de code. Pas seulement des QCM.
6. **Pas de copie de la marque TryHackMe** : on s'inspire du concept (pratique, labs, médailles), jamais du nom ni du branding.
7. **Jamais les mêmes examens pour le même niveau** : le réservoir assure des copies différentes.
8. **Qualité d'abord, traduction après** : on verrouille l'anglais premium avant de traduire.
9. **Référentiel obligatoire** : chaque question et chaque lab cite MITRE ATT&CK, OWASP Top 10, NIST ou ISO 27001.
10. **Red + Blue** : pour chaque attaque enseignée, une défense correspondante.
11. **Validation expert** : un professionnel certifié relit avant le statut "premium".
12. **Plateforme sécurisée** : HTTPS, WAF, labs isolés, journaux d'audit, tests de pénétration.

---

## Comment savoir qu'on a réussi (test final)

Quand toutes les phases sont faites, on relance l'audit de contenu. Le score doit passer de **8 / 20** à au moins **16 / 20**, avec :

- 0 question hors cyber
- 100 % des questions avec référentiel (MITRE / OWASP / NIST / ISO 27001)
- 100 % des questions avec source et licence
- 52 / 52 rooms avec vidéo + lab
- 52 / 52 rooms étiquetées Red Team, Blue Team ou Mixte
- 52 / 52 examens chronométrés
- 100 % des questions relues par un expert certifié
- Plateforme avec HTTPS, WAF, labs isolés, journaux d'audit

---

**Fichier généré le 4 novembre 2026.** Cette roadmap est la constitution : on ne code pas avant qu'elle soit validée.
