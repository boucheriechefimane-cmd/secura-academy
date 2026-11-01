<?php
/**
 * Multilingue : résolution de la langue, traduction du contenu, direction RTL.
 *
 * Les traductions du contenu (titres, questions, indices, explications) sont
 * stockées dans la meta du post : la plateforme fonctionne sans plugin
 * multilingue tiers, mais reste compatible avec les standards WordPress.
 *
 * @package Secura_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gestionnaire de langue.
 */
final class Secura_I18n {

	/**
	 * Langues disponibles.
	 *
	 * @return array
	 */
	public static function languages() {
		return array(
			'fr' => array(
				'label' => 'Français',
				'native' => 'Français',
				'dir'   => 'ltr',
				'flag'  => 'FR',
			),
			'ar' => array(
				'label' => 'Arabe',
				'native' => 'العربية',
				'dir'   => 'rtl',
				'flag'  => 'AR',
			),
			'en' => array(
				'label' => 'Anglais',
				'native' => 'English',
				'dir'   => 'ltr',
				'flag'  => 'EN',
			),
		);
	}

	/**
	 * Branche les hooks.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'maybe_switch_locale' ), 1 );

		/* Priorite haute : si un autre plugin multilingue propose aussi
		   une locale, c'est la nôtre qui gagne (l'apprenant a choisi). */
		add_filter( 'locale', array( __CLASS__, 'filter_locale' ), 99 );
	}

	/**
	 * Langue active pour la requête courante.
	 *
	 * Ordre de priorité : paramètre d'URL, choix enregistré par l'utilisateur,
	 * langue du site, langue par défaut.
	 *
	 * @return string
	 */
	public static function current_lang() {
		static $lang = null;
		static $busy = false;

		if ( null !== $lang ) {
			return $lang;
		}

		/* Garde-fou : le filtre « locale » de WordPress peut rappeler cette
		   methode. On ne doit jamais boucler. */
		if ( $busy ) {
			return 'fr';
		}

		$busy = true;

		$languages = self::languages();
		$default   = 'fr';
		$forced    = self::forced_lang();

		if ( $forced ) {
			$lang = $forced;
			$busy = false;

			return $lang;
		}

		$locale = determine_locale();
		$short  = substr( (string) $locale, 0, 2 );

		if ( isset( $languages[ $short ] ) ) {
			$lang = $short;
			$busy = false;

			return $lang;
		}

		$lang = $default;
		$busy = false;

		return $lang;
	}

	/**
	 * Langue imposee par l'apprenant (parametre d'URL ou preference).
	 *
	 * Cette methode ne doit jamais appeler `determine_locale()` : elle est
	 * utilisee par le filtre « locale » de WordPress, qui l'appellerait en
	 * boucle infinie.
	 *
	 * @return string Langue imposee, ou chaine vide.
	 */
	public static function forced_lang() {
		$languages = self::languages();

		/* Notre parametre a nous (« seca_lang ») : il ne peut pas
		   entrer en conflit avec un autre plugin multilingue. */
		if ( isset( $_GET['seca_lang'] ) ) {
			$candidate = sanitize_key( wp_unslash( $_GET['seca_lang'] ) );

			if ( isset( $languages[ $candidate ] ) ) {
				return $candidate;
			}
		}

		/* « lang » reste accepté, mais seulement si aucun plugin
		   multilingue ne s'en sert deja (Polylang utilise « lang »
		   pour ses propres adresses : on ne se marche pas dessus). */
		if ( isset( $_GET['lang'] ) && ! self::other_language_plugin() ) {
			$candidate = sanitize_key( wp_unslash( $_GET['lang'] ) );

			if ( isset( $languages[ $candidate ] ) ) {
				return $candidate;
			}
		}

		if ( is_user_logged_in() ) {
			$saved = get_user_meta( get_current_user_id(), SECURA_USER_LANG, true );

			if ( is_string( $saved ) && isset( $languages[ $saved ] ) ) {
				return $saved;
			}
		}

		return '';
	}

	/**
	 * Direction d'écriture de la langue active.
	 *
	 * @return string
	 */
	public static function direction() {
		$languages = self::languages();
		$lang      = self::current_lang();

		return isset( $languages[ $lang ]['dir'] ) ? $languages[ $lang ]['dir'] : 'ltr';
	}

	/**
	 * Force la locale WordPress sur la langue choisie.
	 */
	public static function maybe_switch_locale() {
		$lang = self::current_lang();

		if ( $lang ) {
			switch_to_locale( $lang );
		}
	}

	/**
	 * Filtre la locale WordPress pour la aligner sur la langue active.
	 *
	 * @param string $locale Locale détectée.
	 * @return string
	 */
	public static function filter_locale( $locale ) {
		/* On ne passe surtout pas par current_lang() ici : cette fonction
		   Calling determine_locale() appliquerait a nouveau le filtre
		   « locale » et bouclerait a l'infini. */
		$forced = self::forced_lang();

		if ( $forced ) {
			return $forced;
		}

		$languages = self::languages();
		$short     = substr( (string) $locale, 0, 2 );

		return isset( $languages[ $short ] ) ? $short : $locale;
	}

	/**
	 * Enregistre la langue choisie par l'utilisateur.
	 *
	 * @param string $lang Code de langue.
	 * @return bool
	 */
	public static function set_user_lang( $lang ) {
		$languages = self::languages();

		if ( ! isset( $languages[ $lang ] ) ) {
			return false;
		}

		update_user_meta( get_current_user_id(), SECURA_USER_LANG, $lang );

		return true;
	}

	/**
	 * Traduit une chaîne d'interface.
	 *
	 * @param string $key      Clé.
	 * @param string $lang     Langue (défaut : langue active).
	 * @param string $fallback Valeur de repli.
	 * @return string
	 */
	public static function t( $key, $lang = '', $fallback = '' ) {
		$lang  = $lang ? $lang : self::current_lang();
		$dict  = self::dictionary();
		$value = isset( $dict[ $lang ][ $key ] ) ? $dict[ $lang ][ $key ] : '';

		if ( '' === $value && $fallback ) {
			$value = $fallback;
		}

		if ( '' === $value && isset( $dict['fr'][ $key ] ) ) {
			$value = $dict['fr'][ $key ];
		}

		return $value;
	}

	/**
	 * Dictionnaire des chaînes d'interface.
	 *
	 * @return array
	 */
	public static function dictionary() {
		return array(
			'fr' => array(
				'dashboard'        => 'Tableau de bord',
				'paths'            => 'Parcours',
				'rooms'            => 'Rooms',
				'profile'          => 'Mon profil',
				'continue'         => 'Reprendre',
				'start'            => 'Commencer',
				'resume'           => 'Reprendre où vous en étiez',
				'locked'           => 'Verrouillée',
				'completed'        => 'Terminée',
				'in_progress'      => 'En cours',
				'not_started'      => 'À faire',
				'xp'               => 'XP',
				'level'            => 'Niveau',
				'medals'           => 'Médailles',
				'streak'           => 'Série',
				'days'             => 'jours',
				'task'             => 'Tâche',
				'lesson'           => 'Leçon',
				'practice'         => 'Entraînement',
				'test'             => "Test d'application",
				'exam'             => 'Examen',
				'hint'             => "Afficher l'indice",
				'hide_hint'        => "Masquer l'indice",
				'validate'         => 'Valider',
				'correct'          => 'Bonne réponse !',
				'wrong'            => "Pas encore, réessayez.",
				'solved'           => 'Validée',
				'action_note'      => "Réalise l'action dans le terminal, puis confirme.",
				'choose_answer'    => 'Choisis une réponse avant de valider.',
				'lock_task'        => "Terminez la tâche précédente pour continuer.",
				'terminal'         => 'Terminal',
				'terminal_intro'   => 'Tapez une commande puis Entrée.',
				'flag'             => 'Flag',
				'finished'         => 'Terminé',
				'score'            => 'Score',
				'pass'             => 'Seuil',
				'passed'           => 'Reçu',
				'failed'           => 'Non atteint',
				'time_left'        => 'Temps restant',
				'expired'          => 'Temps écoulé',
				'set_lang'         => 'Langue',
				'free'             => '100 % gratuit',
				'next_action'      => 'Prochaine étape',
				'see_errors'       => 'Voir mes erreurs',
				'retry'            => 'Recommencer',
				'next_room'        => 'Room suivante',
				'medal_bronze'     => 'Bronze',
				'medal_silver'     => 'Argent',
				'medal_gold'       => 'Or',
				'level_up'         => 'Niveau supérieur atteint !',
				'new_medal'        => 'Nouvelle médaille',
				'simulated'        => 'Terminal simulé — aucune machine réelle n\'est exécutée.',
				'points'           => 'points',
				'no_hints'         => 'sans indice',
				'lab_running' => 'en marche',
				'lab_expired' => 'expirée',
				'lab_simulated' => 'simulée',
				'lab_error' => 'erreur',
				'lab_idle' => 'arrêtée',
				'terminal_live' => 'machine réelle',
				'terminal_simulated' => 'simulé',
				'terminal_note_live' => "Machine réelle isolée : les commandes s'exécutent dans un conteneur éphémère, sans impact sur l'hébergement.",
				'terminal_note_simulated' => "Terminal simulé : aucune machine réelle n'est exécutée.",
				'target' => 'Cible',
				'deploy_machine' => 'Déployer la machine',
				'stop_machine' => 'Arrêter',
				'threshold' => 'Seuil',
				'format_lesson' => 'Leçon',
				'correct_xp' => "Bonne réponse ! +%d XP",
				'format_quiz' => 'QCM',
				'format_practical' => 'Pratique',
				'format_mixed' => 'Mixte',
				'goal_practical' => "Objectif : mener la manipulation jusqu'au bout.",
				'threshold_short' => 'Seuil',
				'retry_exam' => "Recommencer l'examen",
				'slow_down' => 'Tu vas un peu trop vite : laisse le temps au jeu de souffler.',
				'not_logged_in' => 'Connectez-vous pour continuer.',
				'invalid_nonce' => 'Session expirée. Rechargez la page pour continuer.',
				'explore' => "Explore d'abord la machine dans le terminal.",
				'no_hint' => "Aucun indice n'est disponible pendant un examen.",
				'room_not_found' => 'Room introuvable.',
				'task_not_found' => 'Tâche introuvable.',
				'question_not_found' => 'Question introuvable.',
				'question_invalid' => 'Question invalide.',
				'lang_unavailable' => 'Langue non disponible.',
				'error' => 'Une erreur est survenue.',
				'keep_going' => 'Continue comme ça !',
				'questions' => 'questions',
				'mark_done' => "J'ai terminé cette leçon",
				'lesson_done' => 'Leçon validée !',
				'explanation' => 'Explication',
				'hint_label' => 'Indice :',
				'next_task' => 'Tâche suivante',
				'task_done' => 'Tâche terminée',
				'time_up_hint' => "Relance l'examen pour réessayer.",
				'room_complete' => 'Room terminée, bravo !',
				'lesson'         => 'Leçon',
			'tasks_title'    => 'Les tâches de la room',
			'tasks_noscript' => 'Voici les étapes de cette room (la version interactive nécessite JavaScript).',
			'video_play' => 'Regarder la vidéo du cours',
				'video_source' => 'Voir la vidéo sur la source',
				'video_attribution' => 'Source',
				'video_license' => 'Licence',
				'video_note' => "Vidéo du cours de l'université, en complément de la room.",
				'video_duration' => 'Durée',
			),
			'ar' => array(
				'dashboard'        => 'لوحة التحكم',
				'paths'            => 'المسارات',
				'rooms'            => 'الغرف',
				'profile'          => 'ملفي الشخصي',
				'continue'         => 'متابعة',
				'start'            => 'ابدأ',
				'resume'           => 'تابع من حيث توقفت',
				'locked'           => 'مقفلة',
				'completed'        => 'مكتملة',
				'in_progress'      => 'قيد التقدم',
				'not_started'      => 'لم تبدأ',
				'xp'               => 'نقاط',
				'level'            => 'المستوى',
				'medals'           => 'الأوسمة',
				'streak'           => 'سلسلة',
				'days'             => 'أيام',
				'task'             => 'المهمة',
				'lesson'           => 'درس',
				'practice'         => 'تدريب',
				'test'             => 'اختبار تطبيقي',
				'exam'             => 'امتحان',
				'hint'             => 'أظهر التلميح',
				'hide_hint'        => 'أخفِ التلميح',
				'validate'         => 'تحقّق',
				'correct'          => 'إجابة صحيحة!',
				'wrong'            => 'ليس بعد، حاول مرة أخرى.',
				'solved'           => 'تم التحقق',
				'action_note'      => 'نفّذ الإجراء في الطرفية ثم أكّد.',
				'choose_answer'    => 'اختر إجابة قبل التحقق.',
				'lock_task'        => 'أكمل المهمة السابقة للمتابعة.',
				'terminal'         => 'الطرفية',
				'terminal_intro'   => 'اكتب أمرًا ثم اضغط Enter.',
				'flag'             => 'العلامة',
				'finished'         => 'منتهٍ',
				'score'            => 'النتيجة',
				'pass'             => 'الحد الأدنى',
				'passed'           => 'ناجح',
				'failed'           => 'لم يتحقق',
				'time_left'        => 'الوقت المتبقي',
				'expired'          => 'انتهى الوقت',
				'set_lang'         => 'اللغة',
				'free'             => 'مجاني 100 %',
				'next_action'      => 'الخطوة التالية',
				'see_errors'       => 'اعرض أخطائي',
				'retry'            => 'أعد المحاولة',
				'next_room'        => 'الغرفة التالية',
				'medal_bronze'     => 'برونزي',
				'medal_silver'     => 'فضي',
				'medal_gold'       => 'ذهبي',
				'level_up'         => 'وصلت إلى مستوى أعلى!',
				'new_medal'        => 'وسام جديد',
				'simulated'        => 'طرفية محاكاة — لا يتم تشغيل أي جهاز حقيقي.',
				'points'           => 'نقطة',
				'no_hints'         => 'بلا تلميحات',
				'lab_running' => 'تعمل',
				'lab_expired' => 'انتهت صلاحيتها',
				'lab_simulated' => 'محاكاة',
				'lab_error' => 'خطأ',
				'lab_idle' => 'متوقفة',
				'terminal_live' => 'آلة حقيقية',
				'terminal_simulated' => 'محاكاة',
				'terminal_note_live' => 'آلة حقيقية معزولة: تُنفَّذ الأوامر داخل حاوية مؤقتة دون أي أثر على الاستضافة.',
				'terminal_note_simulated' => 'طرفية محاكاة: لا تُنفَّذ أي آلة حقيقية.',
				'target' => 'الهدف',
				'deploy_machine' => 'انشر الآلة',
				'stop_machine' => 'أوقف',
				'threshold' => 'الحد الأدنى للنجاح',
				'format_lesson' => 'درس',
				'correct_xp' => 'إجابة صحيحة! +%d نقطة',
				'format_quiz' => 'اختيار من متعدد',
				'format_practical' => 'تطبيق عملي',
				'format_mixed' => 'مختلط',
				'goal_practical' => 'الهدف: إكمال العملية العملية حتى نهايتها.',
				'threshold_short' => 'الحد الأدنى',
				'retry_exam' => 'أعد الامتحان',
				'slow_down' => 'أنت سريع جدًا: خذ نفسًا قبل أن تتابع.',
				'not_logged_in' => 'سجّل الدخول للمتابعة.',
				'invalid_nonce' => 'انتهت الجلسة. أعد تحميل الصفحة للمتابعة.',
				'explore' => 'استكشف الآلة في الطرفية أولًا.',
				'no_hint' => 'لا تتوفر تلميحات أثناء الامتحان.',
				'room_not_found' => 'الغرفة غير موجودة.',
				'task_not_found' => 'المهمة غير موجودة.',
				'question_not_found' => 'السؤال غير موجود.',
				'question_invalid' => 'سؤال غير صالح.',
				'lang_unavailable' => 'اللغة غير متاحة.',
				'error' => 'حدث خطأ ما.',
				'keep_going' => 'واصل هكذا!',
				'questions' => 'أسئلة',
				'mark_done' => 'أنهيت هذا الدرس',
				'lesson_done' => 'تم التحقق من الدرس!',
				'explanation' => 'الشرح',
				'hint_label' => 'تلميح:',
				'next_task' => 'المهمة التالية',
				'task_done' => 'اكتملت المهمة',
				'time_up_hint' => 'أعد تشغيل الامتحان للمحاولة مرة أخرى.',
				'room_complete' => 'أكملت الغرفة، أحسنت!',
				'lesson'         => 'الدرس',
			'tasks_title'    => 'مهام الغرفة',
			'tasks_noscript' => 'إليك خطوات هذه الغرفة (النسخة التفاعلية تحتاج إلى جافاسكريبت).',
			'video_play' => 'شاهد فيديو الدرس',
				'video_source' => 'شاهد الفيديو في المصدر',
				'video_attribution' => 'المصدر',
				'video_license' => 'الرخصة',
				'video_note' => 'فيديو درس الجامعة، إضافة إلى الغرفة.',
				'video_duration' => 'المدة',
			),
			'en' => array(
				'dashboard'        => 'Dashboard',
				'paths'            => 'Learning paths',
				'rooms'            => 'Rooms',
				'profile'          => 'My profile',
				'continue'         => 'Continue',
				'start'            => 'Start',
				'resume'           => 'Pick up where you left off',
				'locked'           => 'Locked',
				'completed'        => 'Completed',
				'in_progress'      => 'In progress',
				'not_started'      => 'Not started',
				'xp'               => 'XP',
				'level'            => 'Level',
				'medals'           => 'Medals',
				'streak'           => 'Streak',
				'days'             => 'days',
				'task'             => 'Task',
				'lesson'           => 'Lesson',
				'practice'         => 'Practice',
				'test'             => 'Application test',
				'exam'             => 'Exam',
				'hint'             => 'Show hint',
				'hide_hint'        => 'Hide hint',
				'validate'         => 'Submit',
				'correct'          => 'Correct!',
				'wrong'            => 'Not yet, try again.',
				'solved'           => 'Validated',
				'action_note'      => 'Perform the action in the terminal, then confirm.',
				'choose_answer'    => 'Pick an answer before submitting.',
				'lock_task'        => 'Finish the previous task to continue.',
				'terminal'         => 'Terminal',
				'terminal_intro'   => 'Type a command and press Enter.',
				'flag'             => 'Flag',
				'finished'         => 'Finished',
				'score'            => 'Score',
				'pass'             => 'Pass mark',
				'passed'           => 'Passed',
				'failed'           => 'Not reached',
				'time_left'        => 'Time left',
				'expired'          => 'Time is up',
				'set_lang'         => 'Language',
				'free'             => '100% free',
				'next_action'      => 'Next step',
				'see_errors'       => 'Review my mistakes',
				'retry'            => 'Try again',
				'next_room'        => 'Next room',
				'medal_bronze'     => 'Bronze',
				'medal_silver'     => 'Silver',
				'medal_gold'       => 'Gold',
				'level_up'         => 'Level up!',
				'new_medal'        => 'New medal',
				'simulated'        => 'Simulated terminal — no real machine is running.',
				'points'           => 'points',
				'no_hints'         => 'no hints',
				'lab_running' => 'running',
				'lab_expired' => 'expired',
				'lab_simulated' => 'simulated',
				'lab_error' => 'error',
				'lab_idle' => 'stopped',
				'terminal_live' => 'real machine',
				'terminal_simulated' => 'simulated',
				'terminal_note_live' => 'Isolated real machine: commands run inside an ephemeral container, with no impact on the host.',
				'terminal_note_simulated' => 'Simulated terminal: no real machine is executed.',
				'target' => 'Target',
				'deploy_machine' => 'Deploy the machine',
				'stop_machine' => 'Stop',
				'threshold' => 'Pass mark',
				'format_lesson' => 'Lesson',
				'correct_xp' => 'Correct! +%d XP',
				'format_quiz' => 'Quiz',
				'format_practical' => 'Practical',
				'format_mixed' => 'Mixed',
				'goal_practical' => 'Goal: work through the machine on your own.',
				'threshold_short' => 'Pass mark',
				'retry_exam' => 'Retake the exam',
				'slow_down' => 'You are going too fast: take a breath.',
				'not_logged_in' => 'Log in to continue.',
				'invalid_nonce' => 'Session expired. Reload the page to continue.',
				'explore' => 'Explore the machine in the terminal first.',
				'no_hint' => 'No hints are available during an exam.',
				'room_not_found' => 'Room not found.',
				'task_not_found' => 'Task not found.',
				'question_not_found' => 'Question not found.',
				'question_invalid' => 'Invalid question.',
				'lang_unavailable' => 'Language not available.',
				'error' => 'Something went wrong.',
				'keep_going' => 'Keep going!',
				'questions' => 'questions',
				'mark_done' => 'I finished this lesson',
				'lesson_done' => 'Lesson completed!',
				'explanation' => 'Explanation',
				'hint_label' => 'Hint:',
				'next_task' => 'Next task',
				'task_done' => 'Task complete',
				'time_up_hint' => 'Restart the exam to try again.',
				'room_complete' => 'Room complete, well done!',
				'lesson'         => 'Lesson',
			'tasks_title'    => 'The room tasks',
			'tasks_noscript' => 'Here are the steps of this room (the interactive version needs JavaScript).',
			'video_play' => 'Watch the course video',
				'video_source' => 'Watch the video on the source',
				'video_attribution' => 'Source',
				'video_license' => 'License',
				'video_note' => 'Course video from the university, as a complement to the room.',
				'video_duration' => 'Duration',
			),
		);
	}

	/**
	 * Traduit un contenu de post (titre, extrait, contenu, tâches).
	 *
	 * @param int    $post_id  Identifiant du post.
	 * @param string $lang     Langue demandée.
	 * @param string $meta_key Clé de meta (par défaut celle des rooms).
	 * @return array
	 */
	public static function translate_post( $post_id, $lang = '', $meta_key = '' ) {
		$lang     = $lang ? $lang : self::current_lang();
		$meta_key = $meta_key ? $meta_key : SECURA_META_I18N;
		$raw      = get_post_meta( $post_id, $meta_key, true );

		if ( ! is_array( $raw ) ) {
			$raw = array();
		}

		$out = array(
			'title'   => '',
			'excerpt' => '',
			'content' => '',
			'tasks'   => array(),
		);

		if ( isset( $raw[ $lang ] ) && is_array( $raw[ $lang ] ) ) {
			$out = array_merge( $out, $raw[ $lang ] );
		}

		return $out;
	}

	/**
	 * Applique la traduction au tableau de tâches d'une room.
	 *
	 * @param array  $tasks Tâches d'origine (langue de base).
	 * @param array  $tr    Traductions de la room.
	 * @param string $lang  Langue demandée.
	 * @return array
	 */
	public static function translate_tasks( $tasks, $tr, $lang = '' ) {
		$lang = $lang ? $lang : self::current_lang();

		if ( empty( $tr['tasks'] ) || ! is_array( $tr['tasks'] ) ) {
			return $tasks;
		}

		foreach ( $tasks as $index => $task ) {
			if ( ! isset( $tr['tasks'][ $index ] ) || ! is_array( $tr['tasks'][ $index ] ) ) {
				continue;
			}

			$translation = $tr['tasks'][ $index ];

			if ( ! empty( $translation['title'] ) ) {
				$tasks[ $index ]['title'] = $translation['title'];
			}

			if ( ! empty( $translation['terminal'] ) && is_array( $translation['terminal'] ) ) {
				$terminal = Secura_Terminal::normalize_definition( $translation['terminal'] );

				if ( ! empty( $terminal['steps'] ) ) {
					$tasks[ $index ]['terminal'] = $terminal;
				}
			}

			if ( isset( $translation['content'] ) && '' !== $translation['content'] ) {
				$tasks[ $index ]['content'] = $translation['content'];
			}

			if ( empty( $translation['questions'] ) || ! is_array( $translation['questions'] ) ) {
				continue;
			}

			foreach ( $tasks[ $index ]['questions'] as $q_index => $question ) {
				if ( ! isset( $translation['questions'][ $q_index ] ) ) {
					continue;
				}

				$qt = $translation['questions'][ $q_index ];

				if ( ! empty( $qt['question'] ) ) {
					$tasks[ $index ]['questions'][ $q_index ]['question'] = $qt['question'];
				}

				if ( isset( $qt['hint'] ) && '' !== $qt['hint'] ) {
					$tasks[ $index ]['questions'][ $q_index ]['hint'] = $qt['hint'];
				}

				if ( isset( $qt['explanation'] ) && '' !== $qt['explanation'] ) {
					$tasks[ $index ]['questions'][ $q_index ]['explanation'] = $qt['explanation'];
				}

				if ( isset( $qt['choices'] ) && is_array( $qt['choices'] ) ) {
					$choices = array();

					foreach ( $qt['choices'] as $choice ) {
						$choice = trim( (string) $choice );

						if ( '' !== $choice ) {
							$choices[] = $choice;
						}
					}

					$current = isset( $tasks[ $index ]['questions'][ $q_index ]['choices'] ) ? $tasks[ $index ]['questions'][ $q_index ]['choices'] : array();

					if ( ! empty( $choices ) && count( $choices ) === count( $current ) ) {
						$tasks[ $index ]['questions'][ $q_index ]['choices'] = $choices;
					}
				}
			}
		}

		return $tasks;
	}

	/**
	 * Bascule de langue : enregistre le choix et redirige.
	 *
	 * @param string $lang Code de langue.
	 */
	public static function switch_language() {
		$parametre = 'seca_lang';

		if ( ! isset( $_GET[ $parametre ] ) ) {
			if ( isset( $_GET['lang'] ) && ! self::other_language_plugin() ) {
				$parametre = 'lang';
			} else {
				return;
			}
		}

		$lang = sanitize_key( wp_unslash( $_GET[ $parametre ] ) );

		if ( ! isset( self::languages()[ $lang ] ) ) {
			return;
		}

		if ( is_user_logged_in() ) {
			self::set_user_lang( $lang );
		}

		$target = remove_query_arg( array( 'seca_lang', 'lang' ), self::current_url() );

		wp_safe_redirect( add_query_arg( $parametre, $lang, $target ) );
		exit;
	}

	/**
	 * Un autre plugin multilingue est-il actif (Polylang, WPML...) ?
	 *
	 * Ces plugins utilisent le parametre « lang » dans leurs adresses.
	 * Quand ils sont presents, on ne touche pas a ce parametre : nos
	 * propres liens utilisent « seca_lang », et chacun garde son adresse.
	 *
	 * @return bool
	 */
	public static function other_language_plugin() {
		return defined( 'POLYLANG_VERSION' ) || defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_default_language' );
	}

	/**
	 * URL courante.
	 *
	 * @return string
	 */
	public static function current_url() {
		$scheme = is_ssl() ? 'https' : 'http';
		$host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
		$uri    = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';

		return $scheme . '://' . $host . $uri;
	}
}
