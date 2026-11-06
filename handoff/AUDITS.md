# Secura Academy — Guide des 18 Audits Externes

Comment exécuter, interpréter et corriger les constats des audits.

---

## 1. Lancer tous les audits

```bash
SECA_WP_DIR=/chemin/vers/wordpress \
WP_CLI="php /chemin/vers/wp-cli.phar" \
bash scripts/audit/run-audits.sh
```

**Sortie de succès** : aucun auditeur n’a renvoyé d’échec bloquant ou majeur.
Lisez malgré tout les rapports et leurs limites : un résultat vert ne prouve
pas à lui seul la conformité globale.

**Sortie d’échec** : un ou plusieurs auditeurs ont échoué ou n’ont pas pu s’exécuter ; lire
leurs rapports et journaux, corriger ou compléter les preuves, puis relancer.

---

## 2. Liste des 18 auditeurs

| # | Auditeur | Fichier | Domaine |
|---|----------|---------|---------|
| 1 | seo | `audit-seo.php` | Référencement, méta, OG, Twitter, hreflang, canonique |
| 2 | contenu | `audit-contenu.php` | Qualité des questions, vidéos, traductions |
| 3 | ux-ui | `audit-ux-ui.php` | Expérience utilisateur, accessibilité visuelle |
| 4 | dev | `audit-dev.php` | Qualité du code, échappement, tests internes |
| 5 | securite | `audit-securite.php` | Sécurité des labs, durcissement Docker |
| 6 | pedagogie | `audit-pedagogie.php` | Parcours, progression, certificats |
| 7 | performance | `audit-performance.php` | Core Web Vitals, causes de lenteur |
| 8 | donnees-structurees | `audit-donnees-structurees.php` | Schema.org, JSON-LD |
| 9 | accessibilite | `audit-accessibilite.php` | WCAG, direction de lecture |
| 10 | multilingue | `audit-multilingue.php` | Versions arabe, anglaise, française |
| 11 | rgpd | `audit-rgpd.php` | Conformité RGPD, pages légales |
| 12 | moteur | `audit-moteur.php` | Orchestrateur Docker, cycle de vie |
| 13 | onboarding | `audit-onboarding.php` | Inscription, création de compte |
| 14 | licences | `audit-licences.php` | Attribution, licences universitaires |
| 15 | devops | `audit-devops.php` | CI/CD, architecture |
| 16 | panel-eleves | `audit-panel-eleves.php` | Parcours élève bout en bout |
| 17 | epreuves | `audit-epreuves.php` | Examens chronométrés, tirage aléatoire |
| 18 | drapeaux | `audit-drapeaux.php` | Questions de machine, drapeaux |

---

## 3. Interprétation des niveaux

| Niveau | Signification | Action |
|--------|---------------|--------|
| **Bloquant** | La plateforme ne peut pas être déclarée conforme | Corriger immédiatement |
| **Majeur** | Défaut grave, bloquant pour la conformité | Corriger immédiatement |
| **Mineur** | Défaut à corriger mais non bloquant | Corriger dans le sprint |
| **Info** | Observation sans impact bloquant | À noter |

---

## 4. Rapports générés

Chaque audit parvenu à sa phase de rapport écrit dans `docs/audits/` ;
une erreur de WP-CLI peut empêcher toute production de rapport :
- `seo-YYYY-MM-DD.html`
- `contenu-YYYY-MM-DD.html`
- `drapeaux-YYYY-MM-DD.html`
- etc.

Formats : HTML, Markdown et JSON avec verdict, constats, preuves et échecs
non étayés distincts. Les rapports historiques ne sont pas recalculés.

---

## 5. Constats fréquents et solutions

| Constat | Audit | Solution |
|---------|-------|----------|
| Méta description manquante | seo | Ajouter `post_excerpt` + `_secura_meta_description` |
| Version arabe sans `dir="rtl"` | multilingue / accessibilité | Vérifier `header.php` : `dir="<?php echo esc_attr(secures_learning_direction()); ?>"` |
| Vidéo sans `duration` | contenu | Ajouter `duration` dans `_secura_video` |
| Drapeau absent du lab | drapeaux | Vérifier le scénario, son manifest et le Dockerfile avant toute modification ; ne pas recopier les drapeaux de tous les labs |
| Docker non durci (cap_drop manquant) | securite | Ajouter `cap_drop: [ALL]`, `no-new-privileges:true`, `pids_limit` dans docker-compose |
| 4 parcours sans room liée | multilingue | Vérifier que `single-secura_path.php` liste les rooms avec de vrais liens |
| Contenu non servi aux non-connectés | onboarding | Vérifier l’URL et le comportement réel en visiteur, le statut de la room et les règles d’accès |

---

## 6. Barrière automatique

Chaque auditeur renvoie le code `1` pour un échec bloquant ou majeur, même sans preuve. Le lanceur renvoie le nombre d’auditeurs en échec. Un échec sans preuve apparaît séparément comme **non étayé**, et ne doit pas être présenté comme un constat établi. Un échec mineur non étayé rend le rapport incomplet mais ne bloque pas la barrière.

L’audit d’accessibilité repère les noms indiqués, mais ne mesure pas les
dimensions des cibles WCAG 2.5.8 : une vérification au navigateur reste nécessaire.
