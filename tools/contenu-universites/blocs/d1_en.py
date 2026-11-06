# -*- coding: utf-8 -*-
"""Traduction anglaise des trois rooms du domaine D1.

POURQUOI CE FICHIER EXISTE
--------------------------
Les rooms `concepts-01` a `concepts-03` ont ete ecrites le 7 novembre 2026
en francais, et livrees sans traduction. Consequence mesuree le meme jour :
`mesure-anglais.php` est passe de « les rooms sont reellement en anglais » a
« 84 champs sans traduction », et le job `anglais.yml` est tombe au rouge.
Une room sans anglais n'est pas une room neutre : elle fait echouer la
barriere de qualite du depot, et elle exclut de fait un eleve arabophone ou
anglophone du sujet.

Le fichier est fusionne dans le bloc `d1.py` par `fusion_en.py`, qui refuse
de tourner si le nombre de taches ou de questions ne correspond pas : une
option oubliee decale `correct`, et l'eleve qui repond juste est declare faux.

REGLE DE REDACTION
------------------
La traduction suit le francais, elle ne le reecrit pas. Les leurres gardent
leur longueur relative : un leurre plus court en anglais qu'en francais
ramenerait exactement le biais de longueur que le francais vient de perdre.
Les reperes techniques (chemins, commandes, noms de fichiers) sont recopies
tels quels — `verifier-traductions.php` le verifie et le refuse sinon.
"""

EN = {

    # =================================================================
    # concepts-01 — Controles de securite
    # =================================================================
    'concepts-01': {
        'title': "The turnstile that stopped nobody",
        'excerpt': "A metal detector stands at the entrance. Every door has a badge reader. And the incident happened anyway. Your job is to say what each control is supposed to do — and what none of them was doing.",
        'tasks': [
            {
                'title': "Task 1: Four categories, and one question to ask",
                'content': "<p>A <strong>security control</strong> is a device, a rule or a procedure that changes the probability or the impact of an event. The NIST SP 800-53 framework sorts controls by <em>family</em> (access, audit, physical...), but the classification that matters day to day is the one based on <em>when</em> the control acts. Four categories, and one question for each:</p><ul><li><strong>preventive</strong> — it stops the event. Question: <em>what becomes impossible?</em> A firewall, a badge, a password, a wall.</li><li><strong>detective</strong> — it notices the event without stopping it. Question: <em>how would I know?</em> A camera, an IDS, a log, a metal detector.</li><li><strong>corrective</strong> — it limits the impact once the event has happened. Question: <em>how do I recover, and in how long?</em> A restorable backup, a patch, a recovery plan.</li><li><strong>deterrent</strong> — it acts on the attacker's decision. Question: <em>what do they see, and what do they fear?</em> A visible camera, a sign, a guard.</li></ul><p>Two controls can overlap without replacing each other. A metal detector is <strong>deterrent</strong> (it is visible) and <strong>detective</strong> (it alerts). It is <strong>not preventive</strong>: it does not stop anyone. That is exactly the mistake in the server room described in this room.</p><p>Two neighbouring notions, often confused with the four categories. Each answers a different question, and confusing the <em>category of control</em> with the nature of the control is the most common mistake in an audit:</p><ul><li><strong>compensating</strong> — it replaces a control that cannot be implemented. If the server room cannot have a fire wall, reinforced fire detection is added. This is not the same as <em>corrective</em>: the compensating control replaces an absent preventive one;</li><li><strong>technical, administrative or physical</strong> — this is the <em>nature</em> of the control, not its timing. A badge reader is physical and preventive; a badge policy is administrative and preventive. Both are necessary, neither is enough.</li></ul><p><strong>The question that sorts everything:</strong> \"what happens if this control fails?\" A preventive control that fails lets the event through; a detective control that fails lets it through <em>without anyone knowing</em>. That is why a detective device must itself be monitored.</p><p><strong>Remember:</strong> classifying a control means answering \"when does it act\", not \"how much does it cost\". A control you cannot classify is a control you will not be able to verify.</p>",
                'questions': [],
            },
            {
                'title': "Task 2: Practice — three controls to classify",
                'content': "<p>Three real devices. For each one: what is its category, and what does it actually do?</p>",
                'questions': [
                    {
                        'question': "A magnetic metal detector is installed at the building entrance. A visitor walks through with a metal object: the detector sounds, and an officer intervenes. How do you classify it?",
                        'choices': [
                            "Deterrent and detective: it is visible, and it signals — but it does not block",
                            "Preventive: it physically stops the metal object from passing through",
                            "Corrective: it repairs the incident after the object has entered the building",
                            "Compensating: it replaces the absence of a security officer at the site entrance",
                        ],
                        'hint': "Does the detector stop the passage, or does it signal it?",
                        'explanation': "The detector closes no door: it sounds. It is detective in what it does, and deterrent in what it shows. A preventive control at that spot would be a turnstile, a locked door, or an officer who refuses entry.",
                    },
                    {
                        'question': "A company backs up its data every night, and verifies one restore per quarter. Which category does this verification belong to?",
                        'choices': [
                            "Corrective: the backup restores, and the verification proves it restores",
                            "Preventive: the backup prevents the definitive loss of the data",
                            "Detective only: the verification observes that the backup exists, but restores nothing",
                            "Deterrent: the backup discourages the attacker from encrypting the files",
                        ],
                        'hint': "Is a backup that was never restored a control, or an intention?",
                        'explanation': "The backup alone is an intention. It is the verified restore that makes it a corrective control: you know, proof in hand, that you can go back. Without that test, you discover the backup is unreadable on the day of the incident.",
                    },
                    {
                        'question': "A server room cannot receive a fire wall (listed building, load-bearing walls). Management installs reinforced fire detection and a gas extinguisher instead. How do you name this arrangement?",
                        'choices': [
                            "Compensating: it replaces a preventive control that cannot be installed",
                            "Preventive: it stops the fire from starting in the server room at all, by cutting the power",
                            "Deterrent: it discourages a deliberate fire in the server room, by its visible presence",
                            "Ineffective: without the wall, no other control is of any use and the money is wasted",
                        ],
                        'hint': "The control does not do the same thing as the wall: it compensates for its absence.",
                        'explanation': "A wall stops the spread; reinforced detection and fixed extinguishing limit the impact. You do not replace a control with its equivalent: you compensate for an accepted gap. The word matters: it says the residual risk is higher, and that it was accepted.",
                    },
                ],
            },
            {
                'title': "Task 3: The mission — find the missing control",
                'content': "<p><strong>Mission.</strong> The company workshop was burgled on a Sunday. Four servers disappeared, and nobody knew before Monday morning. The security report for the server room is on the workshop machine.</p><p>Read it, and find <strong>the number of preventive controls</strong> that actually protected the room, as it is written in the report (a number, in digits).</p>",
                'questions': [
                    {
                        'question': "How many PREVENTIVE controls actually protected the server room, according to the report?",
                        'hint': "In the terminal: <code>cat /srv/atelier/rapport-securite.md</code>. Count the lines marked PREVENTIF, and ignore those marked DETECTIF or DISSUASIF.",
                        'explanation': "Three preventive controls: the badge door, the one-person airlock, and the window grilles. The report also lists a camera and a sign — both detective or deterrent. That is the heart of the subject: the room looked protected, and nothing prevented a Sunday burglary, when nobody read a badge and the camera recorded without alerting anyone.",
                    },
                ],
            },
            {
                'title': "Task 4: End-of-room exam",
                'content': "<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>",
                'questions': [
                    {
                        'question': "A detective control fails. What is the consequence, compared with a preventive control that fails?",
                        'choices': [
                            "The preventive one lets the event through; the detective one lets it through without anyone knowing",
                            "No difference: in both cases the event happens and nobody knows about it",
                            "The detective one still blocks the event by itself, while the preventive one no longer blocks anything",
                            "The preventive one is more serious, because a preventive control costs more to replace",
                        ],
                        'explanation': "A failed preventive control shows in use: the door opens, the firewall lets traffic through. A failed detective control does not show: no more alerts, and the illusion that everything is fine. That is why a detective device must itself be monitored — a camera nobody watches is not a control.",
                    },
                    {
                        'question': "A company installs a \"CCTV in operation\" sign at the entrance, without installing any camera. What can be said about this control?",
                        'choices': [
                            "It is deterrent only: it acts on the decision, and observes nothing",
                            "It is detective: the sign signals an intrusion to the security officer",
                            "It is preventive: the sign physically stops unauthorised entry",
                            "It is corrective: the sign helps identify the culprit after the fact",
                        ],
                        'explanation': "The sign plays on the fear of being seen. It observes nothing, since there is no camera — and that is an ethical problem as much as a technical one: announcing surveillance that does not exist is not a control, it is a false statement.",
                    },
                    {
                        'question': "Which sequence of controls correctly describes the protection chain of a backup?",
                        'choices': [
                            "Preventive (restricted access to storage), detective (alert on failure), corrective (verified restore)",
                            "Detective (restricted access to storage), corrective (alert on failure), preventive (verified restore of data)",
                            "Corrective (restricted access to storage), preventive (alert on failure), detective (verified restore of data)",
                            "One control is enough: an encrypted backup covers all three moments at once, with no other measure",
                        ],
                        'explanation': "Restricting access prevents (preventive). Alerting on a failed backup notices (detective). A verified restore repairs (corrective). An encrypted backup covers only one of those three moments: the confidentiality of the medium. It says nothing about whether the backup can be restored.",
                    },
                    {
                        'question': "Why must a compensating control be documented as such, with the residual risk accepted?",
                        'choices': [
                            "Because it does not replace the missing control: the residual risk is higher, and must be accepted by name",
                            "Because a compensating control always costs more than the control it replaces, over time, in maintenance and staff",
                            "Because the law forbids installing a compensating control without a prior written authorisation, signed by the owner",
                            "Because a compensating control automatically becomes preventive after one year of regular use, according to the law",
                        ],
                        'explanation': "The word \"compensating\" is a confession: you know what is missing. If the confession is not written down, with the name of the person who accepts the risk, the organisation believes it is protected when it has chosen not to be. That is exactly what the server room report was hiding.",
                    },
                ],
            },
        ],
    },

    # =================================================================
    # concepts-02 — Zero trust
    # =================================================================
    'concepts-02': {
        'title': "The internal network was safe",
        'excerpt': "\"We are on the internal network, so we are trusted.\" That sentence cost this company more than any other. Follow the attack that proved it false, and decide where the control belongs.",
        'tasks': [
            {
                'title': "Task 1: The castle, and what replaced it",
                'content': "<p>The classic model is called the <strong>perimeter</strong>: an inside network, deemed safe, protected by a wall (the firewall). Once inside, you move freely. That model assumes the inside is populated by trusted people, and that the attacker is outside.</p><p>Three facts made that assumption false, and none of them is a fashion:</p><ul><li><strong>remote work</strong> — users are outside part of the time, and so are their machines;</li><li><strong>the cloud</strong> — applications are no longer in the building, and the \"internal network\" no longer leads to them;</li><li><strong>compromise from the inside</strong> — phishing, an infected workstation, a contractor, a stolen account. The attacker often gets an <em>internal</em> foothold before attacking, and the perimeter no longer stops them.</li></ul><p><strong>Zero trust</strong> — which the framework also calls <em>zero confidence</em> — (NIST SP 800-207) draws a simple rule from this: <em>no implicit trust, whatever the network position</em>. Every access is evaluated every time, on facts: who is asking, from which device, what its state is, towards which resource, for which action.</p><p>Two components, and they must be distinguished:</p><ul><li>the <strong>policy decision point</strong> (PDP): it receives the request, applies the policy, and returns a verdict — allow, deny, or partially allow;</li><li>the <strong>policy enforcement point</strong> (PEP): it enforces the verdict. It is the door, not the judge.</li></ul><p>Four misunderstandings, all common:</p><ul><li>\"zero trust means zero access\" — no. It means <em>verify before access</em>. A legitimate user works normally;</li><li>\"zero trust is a product\" — no. It is an architecture: a policy, context sources, and an enforcement point. A product can serve it, none can replace it;</li><li>\"the internal network is trusted, only the outside is verified\" — that is precisely the error the model corrects;</li><li>\"zero trust removes segmentation\" — no, it makes it finer: the micro-segment replaces the big internal VLAN.</li></ul><p>The principle that sums it up, and that comes from least privilege: <strong>an access granted for one action does not hold for the others</strong>. Reading a folder does not give the right to write in it, and logging in in the morning does not give the right to log in at midnight from another country.</p><p><strong>Remember:</strong> the zero trust question is not \"am I inside or outside\", but \"on which facts did I just decide, and where is the door that enforces my decision\".</p>",
                'questions': [],
            },
            {
                'title': "Task 2: Practice — three implicit trusts",
                'content': "<p>Three situations. For each one: where is the implicit trust, and what should be verified?</p>",
                'questions': [
                    {
                        'question': "An internal application accepts any request coming from an IP address in the 10.0.0.0/8 range, with no other check. What is the zero trust flaw?",
                        'choices': [
                            "Trust comes from the network position, not from identity or the device state",
                            "None: an internal IP address is sufficient proof of identity in practice",
                            "The flaw is the size of the network: a /8 is too large to ever be segmented",
                            "The flaw is the lack of encryption, the network position having nothing to do with it",
                        ],
                        'hint': "An attacker who gets an internal workstation also gets an internal address.",
                        'explanation': "The IP address says where the connection comes from, not who makes it. An infected workstation, a badly configured VPN or a hijacked server all provide a perfectly legitimate internal address. Zero trust asks for a verified identity and a device state, not a position.",
                    },
                    {
                        'question': "An administrator owns a highly privileged account, and also uses it to read email. Why is that a problem in a zero trust architecture?",
                        'choices': [
                            "The privilege is permanent and all-purpose: a routine action exposes a right meant for one precise action only",
                            "It is not a problem as long as the account is protected by a second authentication factor, even a shared one, always",
                            "The problem is the mailbox, which should be forbidden to every system administrator of the site, without exception",
                            "The problem is speed: a privileged account takes longer to authenticate every single time it is opened",
                        ],
                        'hint': "A malicious email read with an administrator account — what happens?",
                        'explanation': "This is least privilege applied over time: an elevated right should exist at the moment of the action, not before or after. A separate administrative account, elevated on demand, shrinks the window during which one reading mistake becomes a total compromise.",
                    },
                    {
                        'question': "A company has deployed a single sign-on portal (SSO) in front of all its applications. Can it say it has done zero trust?",
                        'choices': [
                            "No: SSO verifies identity once, it does not re-evaluate access for every action",
                            "Yes: SSO is the central component of zero trust, everything else follows from it",
                            "Yes, provided the SSO is hosted in the cloud rather than on site",
                            "No: zero trust forbids SSO, which creates a single point of failure",
                        ],
                        'hint': "Once the session is open, what is verified before each action?",
                        'explanation': "SSO is a useful building block — it provides a reliable identity — but it reasons in sessions: once open, the session lasts. Zero trust asks for a decision per action, with the context of the moment. SSO answers \"who are you\", not \"do you still have the right, now, from here\".",
                    },
                ],
            },
            {
                'title': "Task 3: The mission — count the unchecked accesses",
                'content': "<p><strong>Mission.</strong> The service architecture audit is on the workshop machine. It lists the access rules and, for each one, the check applied.</p><p>Find <strong>the number of rules that rely on network position alone</strong>, with no identity check and no device state check, as written in the audit (a number, in digits).</p>",
                'questions': [
                    {
                        'question': "How many access rules rely on network position alone, according to the audit?",
                        'hint': "In the terminal: <code>cat /srv/atelier/audit-architecture.md</code>. Count the lines whose CONTROLE column reads \"position reseau\".",
                        'explanation': "Five rules out of eight check the position only. Three check identity (named account) and one checks the device state — but they are not combined: no rule asks for both at once. That is the underlying flaw: a zero trust architecture evaluates several facts together, not just one.",
                    },
                ],
            },
            {
                'title': "Task 4: End-of-room exam",
                'content': "<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>",
                'questions': [
                    {
                        'question': "In a zero trust architecture, what is the difference between the policy decision point and the policy enforcement point?",
                        'choices': [
                            "The first returns the verdict on the request; the second enforces that verdict",
                            "The first enforces the verdict; the second returns it after inspecting the traffic",
                            "The two are synonyms: the vocabulary changes with the product vendor",
                            "The first is human and the second automatic, in every compliant architecture",
                        ],
                        'explanation': "The PDP judges, the PEP enforces. Confusing them amounts to believing that a firewall decides the policy: it executes it, on another component's orders. That separation is what allows the policy to change without touching the doors.",
                    },
                    {
                        'question': "A workstation is infected by a trojan. How does that illustrate the limit of the perimeter model?",
                        'choices': [
                            "The workstation is internal, therefore deemed safe: the attacker moves around without crossing the wall",
                            "The firewall should have blocked the trojan, so it is badly configured from the start, by the vendor",
                            "The perimeter model is fine, it is the antivirus on the workstation that failed alone this time, not the wall",
                            "It illustrates nothing: an infected workstation is a workstation problem, and not a network problem at all",
                        ],
                        'explanation': "The attacker did not need to force the perimeter: they came in through an email, on a legitimate workstation, and ended up inside with that workstation's rights. Zero trust answers this by verifying every access, including those coming from the inside.",
                    },
                    {
                        'question': "What does \"least privilege\" mean when applied to an administrative account, over time?",
                        'choices': [
                            "The elevated right exists only during the action that justifies it, then it is removed",
                            "The administrative account must be created as late as possible after the employee is hired",
                            "The account must have fewer rights than the other accounts, permanently and verifiably",
                            "The account password must be changed more often than the passwords of all other users",
                        ],
                        'explanation': "Privilege should be a window, not a status. Elevated on demand, for a bounded duration, it reduces the period during which a stolen session or a manipulation mistake becomes a compromise. A permanent administrator account is a right left open twenty-four hours a day.",
                    },
                    {
                        'question': "A company applies zero trust to its users, but lets its servers communicate freely within the same VLAN. What is the problem?",
                        'choices': [
                            "Implicit trust remains between servers: one compromised machine gives access to the others",
                            "None: zero trust only concerns users, and never machines that talk to each other, whatever the stakes",
                            "The problem is the VLAN size: beyond ten servers, another network model is needed, flatter and cheaper",
                            "The problem is encryption: traffic between servers is never encrypted, by default, inside the network",
                        ],
                        'explanation': "This is lateral movement, and it is the reason micro-segmentation exists: a compromised web server must not be able to reach the database simply because they share a VLAN. Zero trust applies to workloads too, often with more at stake than for users.",
                    },
                ],
            },
        ],
    },

    # =================================================================
    # concepts-03 — Gestion du changement + securite physique
    # =================================================================
    'concepts-03': {
        'title': "The back door, left open in December",
        'excerpt': "A maintenance job opens a door that never closes again. Nobody changed the configuration: someone changed it, undocumented, on a Friday. That is how an untracked change becomes an intrusion.",
        'tasks': [
            {
                'title': "Task 1: A change, four traces, and one door",
                'content': "<p><strong>Change management</strong> (<em>change management</em> in English frameworks, and on job adverts) is not paperwork: it is what allows you to answer, six months later, the question \"who changed this, when, why, and who approved it\". NIST SP 800-128 gives its basis: a documented <em>baseline</em>, a <em>change</em> authorised before it is applied, a <em>verification</em> afterwards, and a possible <em>rollback</em>.</p><p>Four elements, and one is always missing in organisations in crisis:</p><ul><li><strong>the baseline</strong> — the written reference state. Without it, nobody knows what changed, because nobody knows what was there before;</li><li><strong>the authorisation</strong> — who has the right to change what. An emergency does not cancel authorisation: it makes it <em>after the fact</em>, with a trace;</li><li><strong>the trace</strong> — the change leaves a record: a ticket, a log, a commit, a work permit. A modification without a trace is not a change, it is an accident waiting to happen;</li><li><strong>the rollback</strong> — how to return to the baseline. A change you cannot undo is a change you must decide twice.</li></ul><p>Three types of change, and only one requires the full trace: <strong>standard</strong> (pre-approved, repetitive), <strong>normal</strong> (approved in committee), <strong>emergency</strong> (applied at once, approved afterwards). The emergency change is the one that breaks everything, because it is applied by someone who has no time to write.</p><p><strong>Physical security</strong> (topic 1.7) obeys exactly the same rules, and that is where this room's story comes together:</p><ul><li><strong>physical access control</strong> — badge, airlock, visitor log. A badge log nobody reads is not a control: it is a lock whose key nobody checks;</li><li><strong>tailgating</strong> — walking in behind an authorised person, without a badge. No badge reader prevents it: only a self-closing airlock, or a rule people actually follow, does;</li><li><strong>the server room</strong> — a room whose access is logged, and whose physical state (temperature, water, fire, power) is monitored;</li><li><strong>the physical change</strong> — a maintenance job that opens a door, moves a cabinet or disables an alarm is a configuration change just like a firewall edit. It must be authorised, traced, and verified afterwards.</li></ul><p><strong>The point that links the two topics:</strong> most physical intrusions involve no break-in at all. They exploit an unfinished change — a service door left in the open position, a contractor badge never revoked, an alarm switched off for a job and never switched back on. This is not a lock defect: it is a change management defect.</p><p><strong>Remember:</strong> a door is only as safe as your knowledge of who last opened it, why, and whether it was closed again. The question holds for the building door as much as for the firewall rule.</p>",
                'questions': [],
            },
            {
                'title': "Task 2: Practice — three changes, three defects",
                'content': "<p>Three real changes. For each one: what is missing, and which door opens?</p>",
                'questions': [
                    {
                        'question': "A contractor works on the air conditioning on a Friday. They disable the server room alarm so it does not trigger, and forget to switch it back on. What is missing?",
                        'choices': [
                            "Verification after the job: nobody checked that the initial state had been restored",
                            "Authorisation: a contractor should never touch an alarm, even when accompanied on site",
                            "The baseline: the alarm was not documented before the contractor's job on the site",
                            "Nothing: this is maintenance work, so it falls outside the change process entirely",
                        ],
                        'hint': "The job may have been authorised. What did not happen afterwards?",
                        'explanation': "Disabling an alarm can be legitimate, and often necessary. What is missing is the verification of the return to the initial state: a box checked at the end of the job, signed by the person accompanying. The door stayed open for weeks, and nobody decided that.",
                    },
                    {
                        'question': "An administrator edits a firewall rule to unblock a user, without opening a ticket. The change works. What is the main risk?",
                        'choices': [
                            "Nobody will know why this rule exists, or whether it can be removed without breaking something",
                            "None, since the change solved the problem and is reversible in theory, at any time, without risk",
                            "The risk is firewall performance, which degrades with every added rule over the years, slowly but surely",
                            "The risk is legal only: the law requires a ticket for every modification of the system, without exception",
                        ],
                        'hint': "In six months, someone will want to clean up the rules. What will they do with that one?",
                        'explanation': "A rule without a trace becomes an untouchable rule: nobody dares to remove it, for fear of breaking a service nobody remembers. The risk is not the change itself, it is that it becomes invisible and permanent. That is how a firewall fills with holes nobody decided.",
                    },
                    {
                        'question': "What is the difference between a normal change and an emergency change, from the point of view of the trace?",
                        'choices': [
                            "None on the trace: the emergency one is simply approved after it is applied, not before",
                            "The emergency one needs no trace, since it answers an exceptional and unforeseen situation",
                            "The emergency one is traced in a different log, which internal audit is not allowed to read",
                            "The emergency one is approved before it is applied, like a normal change, but with a shorter delay",
                        ],
                        'hint': "An emergency changes when the approval happens, not whether it exists.",
                        'explanation': "An emergency change is applied first and approved afterwards — that is what makes it urgent. But the trace remains mandatory, and it is what allows the approval after the fact. An untraced emergency change is indistinguishable from a compromise: you cannot say whether it was decided or suffered.",
                    },
                ],
            },
            {
                'title': "Task 3: The mission — find the change that opened the door",
                'content': "<p><strong>Mission.</strong> An intrusion happened through a service door. The change log is on the workshop machine, and it contains every job on the building.</p><p>Find <strong>the change number</strong> that left the door open (format <code>CHG-XX</code>). It is the one that explains the intrusion.</p>",
                'questions': [
                    {
                        'question': "Which change number left the service door open? (format CHG-XX)",
                        'hint': "In the terminal: <code>cat /srv/atelier/journal-changements.log</code>. Look for a job on a physical access whose final state is not \"closed\".",
                        'explanation': "CHG-07 is a maintenance job on the door closer of the service door, closed without any verification of the final state. The closer was never put back into service, and the door stayed open for three weeks. The log does not say \"door open\": it says \"not verified\". That is exactly the hole change management is supposed to plug.",
                    },
                ],
            },
            {
                'title': "Task 4: End-of-room exam",
                'content': "<p>Four questions, 8 minutes, pass mark 80%. No hints.</p>",
                'questions': [
                    {
                        'question': "Why is the baseline the first element of change management?",
                        'choices': [
                            "Without a written reference state, nobody can say what changed or roll back",
                            "Because the baseline is required by law before any IT change",
                            "Because it replaces authorisation: a change matching the baseline is approved",
                            "Because it measures the system performance before and after the change",
                        ],
                        'explanation': "The baseline is what you compare against. Without it, a change is invisible: it can be neither detected, nor evaluated, nor reversed. This is the meaning of NIST SP 800-128: configuration management starts with a written description of the expected state.",
                    },
                    {
                        'question': "A self-closing airlock protects against which practice, that a simple badge does not block?",
                        'choices': [
                            "Tailgating: entering behind an authorised person, without presenting a badge",
                            "Badge theft: a stolen badge stops working as soon as its holder reports it",
                            "Identity theft: the airlock checks the photo of the badge holder at every passage",
                            "Badge loss: the airlock invalidates a lost badge on the first use made of it",
                        ],
                        'explanation': "Tailgating breaks no lock: it exploits courtesy. A single badge reader does not prevent it, since one presentation opens for two people. Only a device that counts passages — airlock, turnstile — or a rule the teams actually follow limits it.",
                    },
                    {
                        'question': "A maintenance job disables an alarm for two hours. Which control is most often missing, and matters most?",
                        'choices': [
                            "Verification that the alarm was switched back on at the end of the job, signed by a witness",
                            "The contractor's written authorisation, which must be archived for five years by the team that hired him",
                            "Informing employees, who must be told about the deactivation by email on the day of the job",
                            "The presence of a security officer for the whole duration of the job in the building, day and night",
                        ],
                        'explanation': "Disabling an alarm is sometimes unavoidable — a detector fires because of the works. What is not acceptable is failing to verify it came back. The missing control is a simple gesture, at the end of the job, with a name attached. It is the one CHG-07 in this room did not have.",
                    },
                    {
                        'question': "An untraced configuration change is discovered six months later. Why is it more dangerous than a traced change, even if it was legitimate at the time?",
                        'choices': [
                            "Nobody can say whether it was decided or suffered, nor whether it is still needed",
                            "It uses more resources, because it was not optimised when it was applied to the system",
                            "It expires automatically after one year, which breaks the service abruptly one morning",
                            "It is not more dangerous: only the form of the trace tells the two cases apart at all",
                        ],
                        'explanation': "A traced change carries its author, its reason and its date: you can understand it, keep it or remove it. An untraced change is indistinguishable from a back door, and it is that ambiguity that costs: either you keep a hole, or you remove a rule a service may depend on.",
                    },
                ],
            },
        ],
    },
}
