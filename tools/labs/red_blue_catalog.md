# Catalogue de Labs — Red Team / Blue Team

Chaque vulnérabilité enseignée en **Red Team** (attaque) a sa contrepartie en **Blue Team** (détection / défense).
Tous les labs s'appuient sur des référentiels publics : **OWASP Top 10**, **MITRE ATT&CK**, **NIST**.

> Règle : aucun contenu PortSwigger n'est importé. Les images Docker utilisées sont sous licence libre (OWASP Juice Shop = MIT, etc.).

---

## Comment lire ce catalogue

| Colonne | Signification |
|---------|---------------|
| **Lab** | Nom du lab dans la plateforme |
| **Côté** | Red Team (attaque) ou Blue Team (défense) |
| **Référentiel** | OWASP Top 10, MITRE ATT&CK ou NIST |
| **Image Docker** | Image utilisée pour le conteneur isolé |
| **Objectif élève** | Ce que l'élève doit accomplir |
| **Flag** | Chaîne à trouver pour valider le lab |

---

## Labs Red Team (Attaque)

| # | Lab | Référentiel | Image Docker | Objectif | Flag |
|---|-----|-------------|--------------|----------|------|
| R1 | Injection SQL sur formulaire de login | OWASP Top 10 A03 | `bkimminich/juice-shop` | Trouver un contournement d'authentification par injection SQL | `SQL_FLAG_{...}` |
| R2 | Cross-Site Scripting (XSS) réflecté | OWASP Top 10 A07 | `bkimminich/juice-shop` | Injecter un script dans un champ de saisie qui s'exécute chez l'admin | `XSS_FLAG_{...}` |
| R3 | Contrôle d'accès cassé (IDOR) | OWASP Top 10 A01 | `bkimminich/juice-shop` | Accéder au compte d'un autre utilisateur en modifiant l'ID dans l'URL | `IDOR_FLAG_{...}` |
| R4 | Buffer overflow sur binaire vulnérable | MITRE ATT&CK T1068 | Custom C vulnerable | Exploiter un débordement de tampon pour obtenir un shell | `BOF_FLAG_{...}` |
| R5 | Craquage de mot de passe faible | NIST SP 800-63B | Custom hash list | Cracker un hash MD5/SHA1 avec un dictionnaire | `PWD_FLAG_{...}` |
| R6 | Faille de inclusion de fichier (LFI) | OWASP Top 10 A04 | `vulnerables/web-dvwa` | Lire `/etc/passwd` via un paramètre `page=` | `LFI_FLAG_{...}` |
| R7 | Attaque par force brute sur SSH | MITRE ATT&CK T1110 | Custom SSH lab | Trouver le mot de passe d'un service SSH | `SSH_FLAG_{...}` |
| R8 | Man-in-the-Middle sur HTTP | MITRE ATT&CK T1557 | Custom proxy lab | Intercepter et modifier un trafic HTTP non chiffré | `MITM_FLAG_{...}` |

---

## Labs Blue Team (Défense)

| # | Lab | Référentiel | Image Docker | Objectif | Flag |
|---|-----|-------------|--------------|----------|------|
| B1 | Détection d'injection SQL dans les logs | OWASP Top 10 A03 | `ubuntu:22.04` + logs | Analyser des logs Apache et identifier les requêtes SQL malveillantes | `SQL_DETECT_FLAG_{...}` |
| B2 | Blocage XSS via WAF / headers | OWASP Top 10 A07 | `ubuntu:22.04` | Configurer des en-têtes CSP et filtrer les entrées | `XSS_DEFEND_FLAG_{...}` |
| B3 | Durcissement des contrôles d'accès | OWASP Top 10 A01 | Custom app | Vérifier et corriger les politiques d'authentification et d'autorisation | `ACCESS_DEFEND_FLAG_{...}` |
| B4 | Détection de buffer overflow | MITRE ATT&CK T1068 | Custom C + logs | Analyser un crash et activer les protections (canary, ASLR, NX) | `BOF_DEFEND_FLAG_{...}` |
| B5 | Politique de mots de passe robuste | NIST SP 800-63B | Custom AD lab | Configurer longueur minimale, historique, blocage après échecs | `PWD_DEFEND_FLAG_{...}` |
| B6 | Surveillance des inclusions de fichiers | OWASP Top 10 A04 | `ubuntu:22.04` + logs | Détecter des tentatives LFI dans les logs et bloquer l'IP source | `LFI_DEFEND_FLAG_{...}` |
| B7 | Détection de force brute SSH | MITRE ATT&CK T1110 | `ubuntu:22.04` + logs | Analyser `/var/log/auth.log` et configurer fail2ban | `SSH_DEFEND_FLAG_{...}` |
| B8 | Forçage du HTTPS (HSTS) | MITRE ATT&CK T1557 | `nginx` | Configurer HSTS et rediriger tout le trafic HTTP vers HTTPS | `HTTPS_DEFEND_FLAG_{...}` |

---

## Pairing Red / Blue par room

Chaque room de la plateforme doit contenir **au moins une paire** :

| Room (exemple) | Lab Red Team | Lab Blue Team correspondant |
|----------------|--------------|------------------------------|
| Injection SQL | R1 — Injection SQL | B1 — Détection SQL dans logs |
| XSS | R2 — XSS réflecté | B2 — Blocage XSS / headers |
| Contrôle d'accès | R3 — IDOR | B3 — Durcissement accès |
| Binaire / Mémoire | R4 — Buffer overflow | B4 — Détection BOF |
| Mots de passe | R5 — Craquage MD5 | B5 — Politique de mots de passe |
| Inclusion fichier | R6 — LFI | B6 — Surveillance LFI |
| SSH / Réseau | R7 — Force brute SSH | B7 — Détection force brute |
| Chiffrement | R8 — MITM HTTP | B8 — HSTS / HTTPS |

---

## Images Docker recommandées (licences libres)

| Image | Licence | Usage |
|-------|---------|-------|
| `bkimminich/juice-shop` | MIT | Labs web OWASP Top 10 (Red + Blue) |
| `vulnerables/web-dvwa` | GPL | Labs web généraux (Red) |
| `ubuntu:22.04` | Libre | Labs Blue Team (analyse de logs, config) |
| `nginx` | BSD-like | Lab Blue Team HSTS / HTTPS |
| Custom images C vulnérable | À créer (licence Secura) | Labs buffer overflow |

---

## Orchestration

Chaque lab étudiant tourne dans son propre conteneur Docker :
- L'élève clique sur "Démarrer le lab"
- L'orchestrateur lance `docker run` avec un nom unique par étudiant
- L'élève accède via un terminal web (ttyd) ou un port exposé
- Quand l'élève termine ou que le temps est écoulé, le conteneur est détruit

Voir `tools/labs/orchestrator/orchestrator.py` pour l'implémentation.

---

## Critère de validation avant mise en production

- [ ] Chaque image Docker a été testée et le flag est trouvable
- [ ] Chaque lab Blue Team détecte réellement l'attaque de son pair Red Team
- [ ] Aucun conteneur étudiant n'a accès au réseau principal du VPS
- [ ] La licence de chaque image est vérifiée et notée dans la room
- [ ] Un expert certifié (OSCP/CEH/CISSP) a relu les énoncés et solutions
