<?php
/**
 * Les pages legales : politique de confidentialite et mentions legales.
 *
 * Ces textes sont rediges a partir de ce que la plateforme FAIT
 * reellement (code lu, audits joues) et non d'un modele generique :
 * on y parle des donnees que la plateforme stocke reellement, et
 * seulement de celles-la.
 *
 * Les elements que seul l'editeur du site peut connaitre (raison
 * sociale, adresse, hebergeur, contact) sont laisses en placeholders
 * visibles : les remplir est une obligation, pas une option.
 *
 * @package Secura_Academy
 */

return array(

	/* ================================================================
	 * Politique de confidentialite
	 * ============================================================== */
	'politique-de-confidentialite' => array(
		'fr' => array(
			'title'   => 'Politique de confidentialité',
			'excerpt' => 'Quelles données Secura Academy collecte, pourquoi, combien de temps, et comment exercer vos droits.',
			'content' => <<<'HTML'
<p>Secura Academy est une plateforme <strong>gratuite</strong> d’apprentissage de la cybersécurité, en français, en arabe et en anglais. Elle est destinée principalement à des élèves et étudiants, dont beaucoup sont mineurs. Cette page explique, en langage clair, quelles données nous collectons sur vous, pourquoi, combien de temps nous les conservons, et comment exercer vos droits.</p>

<h2>1. Qui est responsable du site ?</h2>
<p>Le responsable du traitement est l’éditeur de Secura Academy. Les informations d’identification de l’éditeur (raison sociale, adresse, coordonnées) figurent dans les <a href="/mentions-legales/">mentions légales</a>.</p>

<h2>2. Quelles données collectons-nous ?</h2>
<p>Nous ne collectons que ce qui est nécessaire au fonctionnement de la plateforme. Concrètement :</p>
<ul>
<li><strong>Votre compte</strong> : le pseudonyme que vous choisissez, votre adresse e-mail, et votre mot de passe — stocké <strong>haché</strong>, jamais en clair, jamais lisible par nous.</li>
<li><strong>Votre progression</strong> : les rooms terminées, les questions validées, les indices utilisés, vos points d’expérience, votre niveau, vos médailles, votre série de jours consécutifs, vos résultats d’examen et vos tentatives.</li>
<li><strong>Vos machines de laboratoire</strong> : l’état de vos machines d’entraînement (nom technique, heure de démarrage, dernière activité). Ces informations servent à savoir quand arrêter et effacer une machine que vous avez oubliée.</li>
<li><strong>Votre langue</strong> : la langue d’affichage que vous choisissez (français, arabe ou anglais).</li>
</ul>

<p><strong>Ce que nous ne collectons pas :</strong></p>
<ul>
<li>Aucun traceur publicitaire, aucun outil de mesure d’audience tiers, aucun pixel de réseau social. La page d’accueil est vérifiée automatiquement à chaque version pour s’en assurer.</li>
<li>Votre nom de famille, votre adresse postale, votre date de naissance, votre photo, ni aucune donnée de géolocalisation.</li>
<li>Le contenu des commandes que vous tapez dans le terminal d’entraînement est traité dans la machine : il n’est pas conservé dans votre profil.</li>
</ul>

<h2>3. Pourquoi, et sur quelle base légale ?</h2>
<ul>
<li><strong>Exécution du service</strong> (article 6.1.b du RGPD) : sans compte ni progression, la plateforme ne peut ni vous faire progresser, ni vous délivrer de certificat.</li>
<li><strong>Sécurité de la plateforme</strong> (article 6.1.f — intérêt légitime) : limiter les tentatives répétées et protéger les machines et les données.</li>
<li><strong>Obligations légales</strong> (article 6.1.c) : conservation minimale des journaux techniques lorsqu’une loi l’exige.</li>
</ul>
<p>Nous ne vendons pas vos données, nous ne leslouons pas, et nous ne les transmettons à aucun annonceur. Nous ne les utiliserons pas pour de la publicité.</p>

<h2>4. Qui a accès à vos données ?</h2>
<p>Les Administrateurs du site peuvent, en cas de nécessité technique ou de signalement, accéder à un compte pour diagnostiquer un problème ou faire respecter les règles. Cet accès est tracé et limité au strict nécessaire.</p>
<p>Nos prestataires techniques (hébergement du site, sauvegarde des données) traitent vos données pour le compte de l’éditeur, dans le cadre d’un contrat qui leur impose la confidentialité et interdit toute réutilisation.</p>

<h2>5. Combien de temps conservons-nous vos données ?</h2>
<ul>
<li><strong>Machines d’entraînement</strong> : elles expirent d’elles-mêmes (une heure d’inactivité par défaut). Au-delà, elles sont arrêtées puis supprimées.</li>
<li><strong>Progression, points, médailles, résultats d’examen</strong> : conservés pendant toute la durée de votre compte, puis supprimés si vous demandez la suppression de votre compte.</li>
<li><strong>Compte</strong> : les données associées au compte sont supprimées à votre demande, ou après une longue période d’inactivité (au moins 12 mois sans connexion).</li>
</ul>

<h2>6. Les mineurs</h2>
<p>La plateforme s’adresse en priorité à des élèves de 11 à 18 ans. <strong>Si vous avez moins de 15 ans, un parent ou un tuteur doit vous aider à créer votre compte et vous accompagner dans son utilisation.</strong> Nous ne collectons aucune information supplémentaire sur les mineurs : nous ne collectons pas leur nom de famille, leur photo, ni leur localisation.</p>
<p>Les responsables d’établissement ou les parents peuvent demander la suppression du compte d’un mineur en écrivant au contact indiqué dans les mentions légales.</p>

<h2>7. Vos droits</h2>
<p>Vous pouvez, à tout moment et gratuitement :</p>
<ul>
<li><strong>Voir</strong> ce que la plateforme sait de vous (droit d’accès) ;</li>
<li><strong>Télécharger</strong> vos données dans un format lisible (droit à la portabilité) ;</li>
<li><strong>Corriger</strong> une information inexacte ;</li>
<li><strong>Demander la suppression</strong> de votre compte et de vos données (droit à l’effacement) ;</li>
<li><strong>Refuser</strong> un traitement ou demander sa limitation ;</li>
<li><strong>Réclamer</strong> auprès de l’autorité de protection des données compétente.</li>
</ul>
<p>Comment faire ? Écrivez au contact indiqué dans les <a href="/mentions-legales/">mentions légales</a> en indiquant votre pseudonyme et l’adresse e-mail de votre compte. Nous répondons dans un délai d’un mois. L’effacement est effectif sous trente jours : votre compte et vos données de progression sont supprimés, et il ne sera pas possible de les récupérer.</p>

<h2>8. Hébergement et transferts</h2>
<p>Le site et ses données sont hébergés hors de l’Union européenne (voir les mentions légales pour l’hébergeur précis). Un transfert de données hors UE est ainsi réalisé. Nous nous assurons qu’il est encadré par des garanties appropriées (clauses contractuelles types de la Commission européenne), et qu’il n’est pas utilisé à des fins de publicité.</p>

<h2>9. Cookies</h2>
<p>Le site utilise uniquement les cookies strictement nécessaires à son fonctionnement, notamment le cookie de session qui vous garde connecté. Ils ne servent ni au pistage publicitaire, ni à l’analyse d’audience. Aucun consentement publicitaire ne vous est donc demandé — parce qu’il n’y en a pas.</p>

<h2>10. Sécurité</h2>
<p>Les mots de passe sont hachés avec un algorithme inadapté à l’attaque (bcrypt). Les communications entre votre navigateur et le site sont chiffrées (HTTPS). Les machines d’entraînement sont isolées : deux élèves ne peuvent pas voir les machines l’un de l’autre, et les données de la plateforme ne sont pas accessibles depuis une machine d’entraînement.</p>

<h2>11. Modifications</h2>
<p>Cette politique peut être mise à jour (par exemple si la plateforme change de fonctionnalités ou d’hébergeur). La date de dernière mise à jour figure en bas de page. Les changements importants sont signalés sur la page d’accueil.</p>
HTML
		),

		'ar' => array(
			'title'   => 'سياسة الخصوصية',
			'excerpt' => 'البيانات التي تجمعها منصة Secura Academy، ولماذا، وكم مدة الاحتفاظ بها، وكيف تُمارس حقوقك.',
			'content' => <<<'HTML'
<p><strong>Secura Academy</strong> منصة مجانية لتعلّم أمن المعلومات، بالفرنسية والعربية والإنجليزية. وهي موجّهة أساسًا إلى التلاميذ والطلاب، وكثيرون منهم قاصرون. توضّح هذه الصفحة بلغة واضحة: ما البيانات التي نجمعها عنك، ولماذا، وكم نحتفظ بها، وكيف تمارس حقوقك.</p>

<h2>1. من المسؤول عن الموقع؟</h2>
<p>المسؤول عن المعالجة هو ناشر Secura Academy. بيانات تعريف الناشر (الاسم التجاري، العنوان، وسائل الاتصال) مذكورة في <a href="/mentions-legales/">البيانات القانونية</a>.</p>

<h2>2. ما البيانات التي نجمعها؟</h2>
<p>لا نجمع إلا ما هو ضروري لعمل المنصة. وبالتفصيل:</p>
<ul>
<li><strong>حسابك</strong>: الاسم المستعار الذي تختاره، وبريدك الإلكتروني، وكلمة مرورك — <strong>مُشفَّرة</strong>، لا تُحفظ أبدًا كنص صريح، ولا نتمكّن من قراءتها.</li>
<li><strong>تقدّمك</strong>: الغرف المنجَزة، الأسئلة المُثبتة، المؤشرات المستعملة، نقاط الخبرة، مستواك، أوسمة التميّز، سلسلة الأيام المتتالية، نتائج الاختبارات ومحاولاتك.</li>
<li><strong>آلات التدريب</strong>: حالة آلاتك التدريبية (الاسم التقني، وقت التشغيل، آخر نشاط). هذه المعلومات تسمح لنا بمعرفة متى نوقف ونحذف آلة نسيتَها.</li>
<li><strong>لغتك</strong>: لغة العرض التي تختارها (الفرنسية، العربية أو الإنجليزية).</li>
</ul>

<p><strong>ما لا نجمعه:</strong></p>
<ul>
<li>لا أدوات تتبع إعلانية، ولا أدوات قياس جمهور من طرف ثالث، ولا بكسلات شبكات اجتماعية. تُفحص الصفحة الرئيسية آليًا عند كل إصدار للتأكد من ذلك.</li>
<li>لا اسمك العائلي، ولا عنوانك البريدي، ولا تاريخ ميلادك، ولا صورتك، ولا أي بيانات تحديد موقع.</li>
<li>الأوامر التي تكتبها في طرفية التدريب تُعالَج داخل الآلة: لا تُحفظ في ملفك.</li>
</ul>

<h2>3. لماذا، وعلى أي أساس قانوني؟</h2>
<ul>
<li><strong>تنفيذ الخدمة</strong> (المادة 6.1.b من القانون العامة لحماية البيانات): بدون حساب ولا تسجيل تقدّم، لا يمكن للمنصة أن تقدّم لك تقدّمك ولا أن تمنحك شهادة.</li>
<li><strong>أمن المنصة</strong> (المادة 6.1.f — المصلحة المشروعة): الحدّ من المحاولات المتكرّرة وحماية الآلات والبيانات.</li>
<li><strong>الالتزامات القانونية</strong> (المادة 6.1.c): حفظ السجلات التقنية إلى الحد الذي تفرضه القانون.</li>
</ul>
<p>لا نبيع بياناتك، ولا نؤجّرها، ولا نسلّمها لأي معلِن. ولن نستعملها في الإعلانات.</p>

<h2>4. من يمكنه الوصول إلى بياناتك؟</h2>
<p>يستطيع مشرفو الموقع، عند الضرورة التقنية أو عند وجود بلاغ، الدخول إلى حساب لتشخيص مشكلة أو تطبيق القواعد. هذا الوصول مسجَّل ومحدود إلى ما تقتضيه الضرورة.</p>
<p>يعالج مقدّمو خدماتنا التقنية (استضافة الموقع، نسخ البيانات الاحتياطية) بياناتك نيابةً عن الناشر، ضمن عقد يفرض عليهم السرّية ويمنع أي إعادة استعمال.</p>

<h2>5. كم نحتفظ ببياناتك؟</h2>
<ul>
<li><strong>آلات التدريب</strong>: تنتهي صلاحيتها من تلقاء نفسها (ساعة خمول افتراضيًا). بعد ذلك تُوقَف ثم تُحذف.</li>
<li><strong>التقدّم والنقاط والأوسمة ونتائج الاختبارات</strong>: تُحفظ طوال مدة حسابك، ثم تُحذف إذا طلبت حذف حسابك.</li>
<li><strong>الحساب</strong>: تُحذف البيانات المرتبطة بالحساب بطلب منك، أو بعد فترة طويلة من عدم الاتصال (12 شهرًا على الأقل).</li>
</ul>

<h2>6. القاصرون</h2>
<p>المنصة موجّهة أساسًا لتلاميذ بين 11 و18 سنة. <strong>إذا كان عمرك أقل من 15 سنة، يجب أن يساعدك والدك أو وصيك على إنشاء حسابك ويرافقك في استعماله.</strong> نحن لا نجمع معلومات إضافية عن القاصرين: لا نجمع اسمهم العائلي، ولا صورتهم، ولا موقعهم.</p>
<p>يمكن لمسؤولي المؤسسات أو للآباء طلب حذف حساب قاصر عبر الكتابة إلى العنوان المذكور في البيانات القانونية.</p>

<h2>7. حقوقك</h2>
<p>يمكنك، في أي وقت وبالمجان: أن <strong>تطّلع</strong> على ما تعرفه المنصة عنك، و<strong>أن تحمّل</strong> بياناتك بصية قابلة للقراءة، وأن <strong>تصحّح</strong> معلومة غير دقيقة، وأن <strong>تطلب حذف</strong> حسابك وبياناتك، وأن <strong>ترفض</strong> معالجة أو تطلب تقييدها، وأن <strong>ترفع شكوى</strong> إلى سلطة حماية البيانات المختصة.</p>
<p>كيف؟ اكتب إلى العنوان المذكور في <a href="/mentions-legales/">البيانات القانونية</a> مع ذكر اسمك المستعار وبريد حسابك. نردّ في أجل شهر واحد. الحذف فعّال في أجل ثلاثين يومًا: يُحذف حسابك وبيانات تقدّمك، ولا يمكن استرجاعها.</p>

<h2>8. الاستضافة والنقل</h2>
<p>الموقع وبياناته مستضافان خارج الاتحاد الأوروبي (انظر البيانات القانونية للاستضافة بالتفصيل). يُنقل إذن البيانات خارج الاتحاد الأوروبي. ونحرص على أن يكون مشمولًا بضمانات مناسبة (بنود عقدية نموذجية للمفوضية الأوروبية)، وأنه لا يُستعمل لأغراض إعلانية.</p>

<h2>9. ملفات تعريف الارتباط</h2>
<p>يستخدم الموقع فقط ملفات تعريف الارتباط الضرورية لعمله، notamment ملف الجلسة الذي يُبقيك مسجّل الدخول. لا تُستعمل للإعلانات التتبّعية ولا لتحليل الجمهور. لذلك لا يُطلب منك أي موافقة إعلانية — لأنه لا توجد إعلانات.</p>

<h2>10. الأمان</h2>
<p>تُشفَّر كلمات المرور بخوارزمية غير مناسبة للتصدّع (bcrypt). وتُشفَّر الاتصالات بين متصفحك والموقع (HTTPS). وآلات التدريب معزولة: لا يرى طالب آلة زميله، وبيانات المنصة غير متاحة من داخل آلة التدريب.</p>

<h2>11. التعديلات</h2>
<p>قد تُحدَّث هذه السياسة (مثلًا إذا تغيّرت المنصة أو الاستضافة). يظهر تاريخ آخر تحديث أسفل الصفحة. وتُعلَن التغييرات المهمة على الصفحة الرئيسية.</p>
HTML
		),

		'en' => array(
			'title'   => 'Privacy policy',
			'excerpt' => 'What data Secura Academy collects, why, for how long, and how to exercise your rights.',
			'content' => <<<'HTML'
<p><strong>Secura Academy</strong> is a <strong>free</strong> cybersecurity learning platform, in French, Arabic and English. It is aimed mainly at school pupils and students, many of whom are minors. This page explains, in plain language, what data we collect about you, why, how long we keep it, and how to exercise your rights.</p>

<h2>1. Who is responsible for the site?</h2>
<p>The controller is the publisher of Secura Academy. The publisher’s identifying details (company name, address, contact) appear in the <a href="/mentions-legales/">legal notices</a>.</p>

<h2>2. What data do we collect?</h2>
<p>We collect only what the platform needs to work. In practice:</p>
<ul>
<li><strong>Your account</strong>: the username you choose, your email address, and your password — stored <strong>hashed</strong>, never in plain text, never readable by us.</li>
<li><strong>Your progress</strong>: completed rooms, validated questions, hints used, experience points, level, medals, your streak of consecutive days, exam results and attempts.</li>
<li><strong>Your lab machines</strong>: the state of your training machines (technical name, start time, last activity). This lets us know when to stop and delete a machine you forgot about.</li>
<li><strong>Your language</strong>: the display language you choose (French, Arabic or English).</li>
</ul>

<p><strong>What we do not collect:</strong></p>
<ul>
<li>No advertising trackers, no third-party analytics, no social media pixels. The home page is automatically checked on every release to make sure that stays true.</li>
<li>Your surname, postal address, date of birth, photo, or any location data.</li>
<li>The commands you type in the training terminal are processed inside the machine: they are not stored in your profile.</li>
</ul>

<h2>3. Why, and on what legal basis?</h2>
<ul>
<li><strong>Performance of the service</strong> (GDPR art. 6.1.b): without an account and saved progress, the platform cannot track your learning or issue you a certificate.</li>
<li><strong>Platform security</strong> (art. 6.1.f — legitimate interest): limiting repeated attempts and protecting machines and data.</li>
<li><strong>Legal obligations</strong> (art. 6.1.c): keeping technical logs where the law requires it.</li>
</ul>
<p>We do not sell, rent or share your data with advertisers. We will not use it for advertising.</p>

<h2>4. Who can access your data?</h2>
<p>Site administrators may, when technically necessary or following a report, access an account to diagnose a problem or enforce the rules. Such access is logged and limited to what is strictly needed.</p>
<p>Our technical providers (site hosting, data backups) process your data on the publisher’s behalf, under a contract that imposes confidentiality and forbids any reuse.</p>

<h2>5. How long do we keep your data?</h2>
<ul>
<li><strong>Training machines</strong>: they expire on their own (one hour of inactivity by default). After that they are stopped and deleted.</li>
<li><strong>Progress, points, medals, exam results</strong>: kept for as long as your account exists, then deleted if you request account deletion.</li>
<li><strong>Account</strong>: the data linked to the account is deleted at your request, or after a long period of inactivity (at least 12 months without logging in).</li>
</ul>

<h2>6. Minors</h2>
<p>The platform is aimed mainly at pupils aged 11 to 18. <strong>If you are under 15, a parent or guardian should help you create your account and accompany you while you use it.</strong> We collect no additional information about minors: we do not collect their surname, their photo, or their location.</p>
<p>School leaders or parents can request the deletion of a minor’s account by writing to the contact address in the legal notices.</p>

<h2>7. Your rights</h2>
<p>At any time and free of charge, you can <strong>see</strong> what the platform knows about you, <strong>download</strong> your data in a readable format, <strong>correct</strong> inaccurate information, <strong>ask for deletion</strong> of your account and data, <strong>object</strong> to processing or ask for it to be restricted, and <strong>complain</strong> to the competent data protection authority.</p>
<p>How? Write to the contact address in the <a href="/mentions-legales/">legal notices</a>, quoting your username and your account email address. We reply within one month. Deletion takes effect within thirty days: your account and progress data are erased and cannot be recovered.</p>

<h2>8. Hosting and transfers</h2>
<p>The site and its data are hosted outside the European Union (see the legal notices for the exact host). A transfer of data outside the EU therefore takes place. We ensure it is covered by appropriate safeguards (the European Commission’s standard contractual clauses), and that it is not used for advertising purposes.</p>

<h2>9. Cookies</h2>
<p>The site uses only the cookies strictly required to operate, in particular the session cookie that keeps you signed in. They are not used for advertising tracking or audience analysis. No advertising consent is therefore requested from you — because there is none.</p>

<h2>10. Security</h2>
<p>Passwords are hashed with an algorithm unsuited to cracking (bcrypt). Connections between your browser and the site are encrypted (HTTPS). Training machines are isolated: two students never share a machine, and the platform’s data is not reachable from inside a training machine.</p>

<h2>11. Changes</h2>
<p>This policy may be updated (for example if the platform or its hosting changes). The last update date is shown at the bottom of the page. Significant changes are announced on the home page.</p>
HTML
		),
	),

	/* ================================================================
	 * Mentions legales
	 * ============================================================== */
	'mentions-legales' => array(
		'fr' => array(
			'title'   => 'Mentions légales',
			'excerpt' => 'Éditeur, hébergeur, propriété intellectuelle et responsabilité du site Secura Academy.',
			'content' => <<<'HTML'
<p>Les présentes mentions légales renseignent l’éditeur, l’hébergeur et les conditions d’utilisation du site <strong>Secura Academy</strong>, plateforme gratuite d’apprentissage de la cybersécurité.</p>

<h2>1. Éditeur du site</h2>
<ul>
<li><strong>Raison sociale</strong> : <em>[à compléter avant la mise en ligne]</em></li>
<li><strong>Forme juridique</strong> : <em>[à compléter]</em></li>
<li><strong>Siège social</strong> : <em>[adresse à compléter]</em></li>
<li><strong>Directeur de la publication</strong> : <em>[nom à compléter]</em></li>
<li><strong>Contact</strong> : <em>[adresse e-mail de contact à compléter]</em></li>
<li><strong>Numéro d’immatriculation</strong> : <em>[le cas échéant]</em></li>
</ul>
<p>Le site est associatif et gratuit : aucune publicité, aucun abonnement payant, aucune revente de données.</p>

<h2>2. Hébergeur</h2>
<ul>
<li><strong>Nom</strong> : <em>[hébergeur à compléter]</em></li>
<li><strong>Adresse</strong> : <em>[adresse de l’hébergeur à compléter]</em></li>
<li><strong>Site web</strong> : <em>[URL de l’hébergeur]</em></li>
</ul>
<p>Les données des comptes (pseudonymes, adresses e-mail, progression) sont hébergées hors de l’Union européenne. Le détail figure dans la <a href="/politique-de-confidentialite/">politique de confidentialité</a>.</p>

<h2>3. Propriété intellectuelle</h2>
<p>La conception du site, les textes rédigés pour la plateforme, les scénarios, les ateliers, les machines d’entraînement et le code du plugin et du thème appartiennent à l’éditeur. Ils sont réutilisables au titre de la licence mentionnée dans le dépôt du projet et dans le registre des sources.</p>
<p><strong>Les contenus repris d’autres sources</strong> (cours universitaires, vidéos, feuilles de référence) restent la propriété de leurs auteurs respectifs. Chaque room concerned affiche l’auteur, la source et la licence : ces mentions doivent être conservées en cas de réutilisation. Un registre complet des sources et des licences est tenu dans le dépôt du projet.</p>

<h2>4. Limitation de responsabilité</h2>
<p>Les contenus pédagogiques sont fournis à titre informatif et éducatif. L’éditeur ne peut garantir l’adéquation d’un contenu à un usage particulier. L’utilisation des machines d’entraînement est faite sous la responsabilité de l’utilisateur, dans un environnement isolé. Les Commands exécutées dans une machine d’entraînement ne peuvent affecter ni le site, ni les données d’un autre élève.</p>

<h2>5. Liens externes</h2>
<p>Le site peut citer des sources externes (universités, fondations, documentation). Ces liens sont proposés à titre documentaire ; l’éditeur n’exerce aucun contrôle sur le contenu de ces sites et n’est pas responsable de leurs pratiques en matière de données personnelles.</p>

<h2>6. Signalement</h2>
<p>Pour signaler une erreur dans un contenu, une donnée inexacte, ou un problème technique : utilisez l’adresse de contact ci-dessus. Les demandes relatives aux données personnelles sont traitées conformément à la <a href="/politique-de-confidentialite/">politique de confidentialité</a>.</p>

<h2>7. Droit applicable</h2>
<p>Les présentes mentions légales sont soumises au droit applicable dans l’État du siège de l’éditeur. Tout litige relatif à l’utilisation du site relève de la compétence des tribunaux compétents de ce ressort, sans préjudice des règles protectrices applicables aux consommateurs.</p>
HTML
		),

		'ar' => array(
			'title'   => 'البيانات القانونية',
			'excerpt' => 'الناشر، المضيف، الملكية الفكرية والمسؤولية القانونية عن موقع Secura Academy.',
			'content' => <<<'HTML'
<p>توضّح هذه البيانات القانونية الناشرَ والمضيفَ وشروط استعمال موقع <strong>Secura Academy</strong>، منصة مجانية لتعلّم أمن المعلومات.</p>

<h2>1. ناشر الموقع</h2>
<ul>
<li><strong>الاسم التجاري</strong>: <em>[يُملأ قبل النشر]</em></li>
<li><strong>الشكل القانوني</strong>: <em>[يُملأ]</em></li>
<li><strong>العنوان</strong>: <em>[العنوان يُملأ]</em></li>
<li><strong>مدير النشر</strong>: <em>[الاسم يُملأ]</em></li>
<li><strong>للتواصل</strong>: <em>[بريد إلكتروني للتواصل يُملأ]</em></li>
<li><strong>رقم التسجيل</strong>: <em>[إن وُجد]</em></li>
</ul>
<p>الموقع جمعوي ومجاني: لا إعلانات، ولا اشتراك مدفوع، ولا إعادة بيع للبيانات.</p>

<h2>2. المضيف</h2>
<ul>
<li><strong>الاسم</strong>: <em>[المضيف يُملأ]</em></li>
<li><strong>العنوان</strong>: <em>[عنوان المضيف يُملأ]</em></li>
<li><strong>الموقع</strong>: <em>[رابط المضيف]</em></li>
</ul>
<p>تُستضاف بيانات الحسابات (الأسماء المستعارة، البريد الإلكتروني، التقدّم) خارج الاتحاد الأوروبي. التفاصيل في <a href="/politique-de-confidentialite/">سياسة الخصوصية</a>.</p>

<h2>3. الملكية الفكرية</h2>
<p>تصميم الموقع والنصوص المكتوبة خصيصًا للمنصة والسيناريوهات والمختبرات والكود الخاص بالإضافة والقالب ملك للناشر. ويُسمح بإعادة استعمالها وفق الرخصة المذكورة في مستودع المشروع وسجل المصادر.</p>
<p><strong>المحتوى المأخوذ من مصادر أخرى</strong> (دورات جامعية، فيديوهات، مراجع) يبقى ملكًا لمؤلفيه. تذكر كل غرفة معنيةً المؤلف والمصدر والرخصة: يجب الحفاظ على هذه الإشارات عند إعادة الاستعمال. ويُحتفظ بسجل كامل للمصادر والرخص في مستودع المشروع.</p>

<h2>4. حدود المسؤولية</h2>
<p>تُقدَّم المحتويات التعليمية لأغراض التعلّم. ولا يمكن للناشر أن يضمن ملاءمة محتوى معيّن لاستعمال معيّن. استعمال آلات التدريب يتم على مسؤولية المستخدم، في بيئة معزولة. والأوامر المنفَّذة داخل آلة التدريب لا يمكن أن تمسّ الموقع ولا بيانات طالب آخر.</p>

<h2>5. الروابط الخارجية</h2>
<p>قد يستشهد الموقع بمصادر خارجية (جامعات، جمعيات، توثيق). تُقدَّم هذه الروابط لأغراض التوثيق فقط؛ ولا يراقب الناشر محتوى هذه المواقع، ولا يسأل عن ممارساتها في مجال البيانات الشخصية.</p>

<h2>6. الإبلاغ</h2>
<p>للإبلاغ عن خطأ في محتوى أو معلومة غير دقيقة أو عطل تقني: استعمل عنوان التواصل أعلاه. وتُعالَج الطلبات المتعلقة بالبيانات الشخصية وفقًا لـ<a href="/politique-de-confidentialite/">سياسة الخصوصية</a>.</p>

<h2>7. القانون المطبَّق</h2>
<p>تخضع هذه البيانات القانونية للقانون المطبَّق في الدولة التي يقع فيها مقر الناشر. وأي نزاع يتعلق باستعمال الموقع يخضع لاختصاص محاكم ذلك الصنف، دون الإخلال بالقواعد الحمائية المطبَّقة على المستهلكين.</p>
HTML
		),

		'en' => array(
			'title'   => 'Legal notices',
			'excerpt' => 'Publisher, host, intellectual property and liability for the Secura Academy site.',
			'content' => <<<'HTML'
<p>These legal notices identify the publisher, the host and the terms of use of the <strong>Secura Academy</strong> site, a free cybersecurity learning platform.</p>

<h2>1. Site publisher</h2>
<ul>
<li><strong>Company name</strong>: <em>[to be completed before going live]</em></li>
<li><strong>Legal form</strong>: <em>[to be completed]</em></li>
<li><strong>Registered office</strong>: <em>[address to be completed]</em></li>
<li><strong>Publication director</strong>: <em>[name to be completed]</em></li>
<li><strong>Contact</strong>: <em>[contact email address to be completed]</em></li>
<li><strong>Registration number</strong>: <em>[if applicable]</em></li>
</ul>
<p>The site is a non-profit and free: no advertising, no paid subscription, no resale of data.</p>

<h2>2. Hosting</h2>
<ul>
<li><strong>Name</strong>: <em>[host to be completed]</em></li>
<li><strong>Address</strong>: <em>[host address to be completed]</em></li>
<li><strong>Website</strong>: <em>[host URL]</em></li>
</ul>
<p>Account data (usernames, email addresses, progress) is hosted outside the European Union. Details are in the <a href="/politique-de-confidentialite/">privacy policy</a>.</p>

<h2>3. Intellectual property</h2>
<p>The site’s design, the texts written for the platform, the scenarios, the labs, and the plugin and theme code belong to the publisher. They may be reused under the licence stated in the project repository and in the sources register.</p>
<p><strong>Content taken from other sources</strong> (university courses, videos, reference sheets) remains the property of their respective authors. Each room concerned displays the author, the source and the licence: those notices must be kept on reuse. A complete register of sources and licences is kept in the project repository.</p>

<h2>4. Limitation of liability</h2>
<p>The educational content is provided for learning and information purposes. The publisher cannot guarantee that any content is suitable for a particular use. Use of the training machines is the user’s responsibility, in an isolated environment. Commands run inside a training machine cannot affect the site or another student’s data.</p>

<h2>5. External links</h2>
<p>The site may cite external sources (universities, foundations, documentation). These links are offered for reference; the publisher does not control those sites’ content and is not responsible for their personal-data practices.</p>

<h2>6. Reporting</h2>
<p>To report an error in a piece of content, inaccurate data, or a technical problem: use the contact address above. Requests relating to personal data are handled in accordance with the <a href="/politique-de-confidentialite/">privacy policy</a>.</p>

<h2>7. Governing law</h2>
<p>These legal notices are governed by the law applicable in the state where the publisher is registered. Any dispute relating to use of the site falls under the jurisdiction of the competent courts of that jurisdiction, without prejudice to the protective rules applicable to consumers.</p>
HTML
		),
	),
);
