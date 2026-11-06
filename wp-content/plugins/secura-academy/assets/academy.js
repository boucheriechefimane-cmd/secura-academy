/**
 * Secura Academy — moteur de jeu du lecteur de room.
 *
 * Principes :
 * - toutes les réponses attendues vivent côté serveur, le navigateur ne
 *   reçoit jamais la liste des bonnes réponses ;
 * - chaque action est validée par le serveur (nonce + session + état) ;
 * - l'interface est reconstruite à partir des réponses serveur.
 */
( function () {
	'use strict';

	var cfg = window.SecuraAcademy || {};
	var strings = cfg.i18n || {};
	var levels = Array.isArray( cfg.levels ) ? cfg.levels : [];

	/**
	 * Traduit une clé de l'interface.
	 *
	 * @param {string} key      Clé.
	 * @param {string} fallback Valeur de repli.
	 * @return {string} Libellé.
	 */
	function t( key, fallback ) {
		if ( strings && strings[ key ] ) {
			return strings[ key ];
		}

		return fallback || key;
	}

	/* =====================================================================
	 * Requête AJAX
	 * ================================================================== */

	/**
	 * Envoie une requête au plugin.
	 *
	 * @param {string} action Action WordPress.
	 * @param {Object} data   Données.
	 * @return {Promise<Object>} Données de la réponse.
	 */
	function post( action, data ) {
		var body = new FormData();

		body.append( 'action', action );
		body.append( 'nonce', cfg.nonce || '' );

		Object.keys( data || {} ).forEach( function ( key ) {
			body.append( key, data[ key ] );
		} );

		return fetch( cfg.ajaxUrl, {
			method: 'POST',
			body: body,
			credentials: 'same-origin'
		} ).then( function ( response ) {
			return response.json();
		} ).then( function ( json ) {
			if ( ! json || ! json.success ) {
				var error = new Error( ( json && json.data && json.data.message ) || t( 'error', 'Une erreur est survenue.' ) );

				error.code = ( json && json.data && json.data.code ) || '';

				/* Si l'eleve n'est pas connecte, on transporte les
				   adresses de connexion et d'inscription : l'ecran
				   pourra proposer un clic au lieu d'un mur. */
				if ( 'not_logged_in' === error.code ) {
					error.action = {
						url: ( json && json.data && json.data.register_url ) || '',
						label: t( 'create_account', 'Creer un compte gratuit' )
					};
				}

				throw error;
			}

			return json.data;
		} );
	}

	/* =====================================================================
	 * Utilitaires d'interface
	 * ================================================================== */

	/**
	 * Crée un élément.
	 *
	 * @param {string} tag   Balise.
	 * @param {string} cls   Classes.
	 * @param {string} text  Texte.
	 * @return {HTMLElement} Élément.
	 */
	function el( tag, cls, text ) {
		var node = document.createElement( tag );

		if ( cls ) {
			node.className = cls;
		}

		if ( typeof text !== 'undefined' && null !== text ) {
			node.textContent = text;
		}

		return node;
	}

	/**
	 * Affiche une notification éphémère.
	 *
	 * @param {string} message Message.
	 * @param {boolean} bad    Erreur ?
	 */
	function toast( message, bad, action ) {
		var wrap = document.querySelector( '.seca-toast-wrap' );

		if ( ! wrap ) {
			wrap = el( 'div', 'seca-toast-wrap' );
			document.body.appendChild( wrap );
		}

		var item = el( 'div', 'seca-toast' + ( bad ? ' is-bad' : '' ), message );

		/* Quand l'eleve n'est pas connecte, on ne laisse pas un simple
		   message : on propose la porte a pousser. */
		if ( action && action.url ) {
			var link = el( 'a', 'seca-toast__link', action.label || action.url );

			link.setAttribute( 'href', action.url );
			item.appendChild( link );
		}

		wrap.appendChild( item );

		window.setTimeout( function () {
			if ( item.parentNode ) {
				item.parentNode.removeChild( item );
			}
		}, 3600 );
	}

	/**
	 * Anime des confettis.
	 */
	function confetti() {
		var holder = el( 'div', 'seca-confetti' );
		var colors = [ '#2dd4a7', '#38bdf8', '#fbbf24', '#cbd5e1', '#f472b6' ];

		for ( var i = 0; i < 70; i++ ) {
			var piece = el( 'i' );

			piece.style.left = Math.random() * 100 + 'vw';
			piece.style.background = colors[ i % colors.length ];
			piece.style.animationDuration = ( 2 + Math.random() * 2 ) + 's';
			piece.style.animationDelay = ( Math.random() * 0.6 ) + 's';
			piece.style.transform = 'rotate(' + Math.round( Math.random() * 360 ) + 'deg)';

			holder.appendChild( piece );
		}

		document.body.appendChild( holder );

		window.setTimeout( function () {
			if ( holder.parentNode ) {
				holder.parentNode.removeChild( holder );
			}
		}, 5200 );
	}

	/**
	 * Affiche l'écran de passage de niveau.
	 *
	 * @param {Object} level Niveau.
	 */
	function showLevelUp( level ) {
		var overlay = document.querySelector( '.seca-overlay' );

		if ( ! overlay ) {
			overlay = el( 'div', 'seca-overlay' );
			overlay.appendChild( el( 'div', 'seca-overlay-card' ) );
			document.body.appendChild( overlay );

			overlay.addEventListener( 'click', function () {
				overlay.classList.remove( 'is-open' );
			} );
		}

		var card = overlay.querySelector( '.seca-overlay-card' );

		card.innerHTML = '';

		card.appendChild( el( 'p', 'seca-overlay-kicker', t( 'level_up', 'Niveau supérieur !' ) ) );
		card.appendChild( el( 'div', 'seca-overlay-level', level.number + ' · ' + level.label ) );
		card.appendChild( el( 'p', 'seca-overlay-xp', t( 'keep_going', 'Continue comme ça !' ) ) );

		overlay.classList.add( 'is-open' );

		confetti();

		window.setTimeout( function () {
			overlay.classList.remove( 'is-open' );
		}, 6000 );
	}

	/**
	 * Met à jour les compteurs du tableau de bord présents sur la page.
	 *
	 * @param {Object} data Réponse serveur.
	 */
	function syncDashboard( data ) {
		var xpNode = document.querySelector( '[data-seca-xp]' );

		if ( xpNode && typeof data.total_xp !== 'undefined' ) {
			xpNode.textContent = String( data.total_xp );
		}

		var levelNode = document.querySelector( '[data-seca-level]' );

		if ( levelNode && data.level ) {
			levelNode.textContent = data.level.number + ' · ' + data.level.label;
		}

		var bar = document.querySelector( '[data-seca-xpbar]' );

		if ( bar && data.level ) {
			var range = null === data.level.max ? 1 : ( data.level.max + 1 - data.level.min );
			var percent = Math.min( 100, Math.max( 0, Math.round( ( ( data.total_xp - data.level.min ) / range ) * 100 ) ) );

			bar.style.width = percent + '%';
			bar.setAttribute( 'aria-valuenow', String( percent ) );
		}
	}

	/* =====================================================================
	 * Changement de langue
	 * ================================================================== */

	/**
	 * Selection de la langue.
	 *
	 * Le selecteur est fait de vrais liens : chaque langue a SON adresse
	 * (« ?seca_lang=fr|ar|en »). C'est le serveur qui decide ce qu'il sert
	 * a cette adresse ; JavaScript ne fait qu'enregistrer la preference
	 * avant de suivre le lien.
	 *
	 * Pourquoi ce detour : l'ancien code rechargeait l'adresse courante.
	 * Avec « ?seca_lang=ar » dans la barre, le serveur reserve ce
	 * parametre a la langue de l'adresse : le choix venait d'etre
	 * enregistre, et la page se rechargeait ... dans l'ancienne langue.
	 * Le selecteur paraissait donc ne rien faire.
	 */
	function bindLanguageSwitch() {
		var links = document.querySelectorAll( '[data-seca-lang]' );

		Array.prototype.forEach.call( links, function ( link ) {
			var lang = link.getAttribute( 'data-seca-lang' );
			var target = link.getAttribute( 'href' ) || '';

			if ( ! lang || ! target ) {
				return;
			}

			link.addEventListener( 'click', function ( event ) {
				if ( lang === cfg.lang ) {
					return;
				}

				event.preventDefault();

				if ( link.getAttribute( 'aria-busy' ) ) {
					return;
				}

				link.setAttribute( 'aria-busy', 'true' );

				/* Le lien fonctionne meme si l'enregistrement echoue : la
				   preference est un confort, pas une condition. */
				var suivre = function () {
					window.location.href = target;
				};

				post( 'secura_set_lang', { lang: lang } ).then( suivre ).catch( suivre );
			} );
		} );
	}

	/**
	 * Bouton d'impression du certificat.
	 */
	function bindPrintButtons() {
		var buttons = document.querySelectorAll( '[data-seca-print]' );

		Array.prototype.forEach.call( buttons, function ( button ) {
			button.addEventListener( 'click', function () {
				window.print();
			} );
		} );
	}

	/**
	 * Facade video : l'iframe n'est cree qu'au clic.
	 *
	 * Sans JavaScript, le lien « Voir la video sur la source » reste
	 * utilisable : la room n'est jamais cassee.
	 */
	function bindVideoFacades() {
		var blocks = document.querySelectorAll( '[data-seca-video]' );

		Array.prototype.forEach.call( blocks, function ( block ) {
			var play = block.querySelector( '[data-seca-video-play]' );
			var player = block.querySelector( '[data-seca-video-player]' );
			var videoId = block.getAttribute( 'data-seca-video-id' );

			if ( ! play || ! player || ! videoId ) {
				return;
			}

			play.addEventListener( 'click', function () {
				if ( player.getAttribute( 'data-seca-video-loaded' ) ) {
					return;
				}

				var frame = document.createElement( 'iframe' );

				frame.src = 'https://www.youtube-nocookie.com/embed/' +
					encodeURIComponent( videoId ) +
					'?rel=0&modestbranding=1&playsinline=1&autoplay=1';
				frame.title = play.getAttribute( 'aria-label' ) || '';
				frame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share';
				frame.allowFullscreen = true;
				frame.setAttribute( 'loading', 'lazy' );

				player.appendChild( frame );
				player.setAttribute( 'data-seca-video-loaded', '1' );
				player.hidden = false;
				play.hidden = true;
			} );
		} );
	}

	/* =====================================================================
	 * Lecteur de room
	 * ================================================================== */

	bindPrintButtons();
	bindVideoFacades();

	var app = document.querySelector( '[data-seca-room]' );

	if ( ! app ) {
		bindLanguageSwitch();
		return;
	}

	var roomId = parseInt( app.getAttribute( 'data-seca-room' ), 10 ) || 0;

	var nav = app.querySelector( '[data-seca-task-nav]' );
	var view = app.querySelector( '[data-seca-task-view]' );
	var headerNode = app.querySelector( '[data-seca-task-header]' );
	var contentNode = app.querySelector( '[data-seca-task-content]' );
	var questionsNode = app.querySelector( '[data-seca-questions]' );
	var actionsNode = app.querySelector( '[data-seca-task-actions]' );
	var statusNode = app.querySelector( '[data-seca-task-status]' );
	var terminalBox = app.querySelector( '[data-seca-terminal]' );
	var terminalScreen = app.querySelector( '[data-seca-terminal-screen]' );
	var terminalForm = app.querySelector( '[data-seca-terminal-form]' );
	var terminalInput = app.querySelector( '[data-seca-terminal-input]' );
	var terminalBadge = app.querySelector( '[data-seca-terminal-badge]' );
	var terminalNote = app.querySelector( '[data-seca-terminal-note]' );
	var labBox = app.querySelector( '[data-seca-lab]' );
	var labState = app.querySelector( '[data-seca-lab-state]' );
	var labMessage = app.querySelector( '[data-seca-lab-message]' );
	var labTarget = app.querySelector( '[data-seca-lab-target]' );
	var labStart = app.querySelector( '[data-seca-lab-start]' );
	var labStop = app.querySelector( '[data-seca-lab-stop]' );
	var bar = app.querySelector( '[data-seca-room-bar]' );
	var barText = app.querySelector( '[data-seca-room-progress-text]' );

	var room = null;
	var currentIndex = 0;
	var commandHistory = [];
	var historyIndex = -1;
	var timerHandle = null;
	var timeLeft = 0;

	/**
	 * Met à jour la barre de progression de la room.
	 */
	function updateProgress() {
		if ( ! room ) {
			return;
		}

		var solved = 0;
		var total = 0;

		room.tasks.forEach( function ( task ) {
			total += task.questions;

			solved += Math.min( task.solved, task.questions );
		} );

		var percent = total > 0 ? Math.round( ( solved / total ) * 100 ) : 0;

		if ( bar ) {
			bar.style.width = percent + '%';
			bar.setAttribute( 'aria-valuenow', String( percent ) );
		}

		if ( barText ) {
			barText.textContent = percent + ' % · ' + solved + '/' + total + ' ' + t( 'questions', 'questions' );
		}
	}

	/**
	 * Libellé lisible d'un format de tâche.
	 *
	 * @param {string} format Format.
	 * @return {string} Libellé.
	 */
	function formatLabel( format ) {
		if ( 'lecon' === format ) {
			return t( 'format_lesson', 'Leçon' );
		}

		if ( 'pratique' === format ) {
			return t( 'format_practical', 'Pratique' );
		}

		if ( 'mixte' === format ) {
			return t( 'format_mixed', 'Mixte' );
		}

		return t( 'format_quiz', 'QCM' );
	}

	/**
	 * Construit la navigation des tâches.
	 */
	function renderNav() {
		if ( ! nav ) {
			return;
		}

		nav.innerHTML = '';

		room.tasks.forEach( function ( task, index ) {
			var button = el( 'button', 'seca-task-tab' );

			button.type = 'button';

			if ( index === currentIndex ) {
				button.classList.add( 'is-active' );
			}

			if ( task.done ) {
				button.classList.add( 'is-done' );
			}

			if ( ! task.unlocked ) {
				button.disabled = true;
			}

			var badge = el( 'span', 'seca-task-tab-index', String( index + 1 ) );

			button.appendChild( badge );
			button.appendChild( el( 'span', 'seca-task-tab-label', task.title ) );

			if ( task.format && 'qcm' !== task.format && 'lecon' !== task.format ) {
				button.appendChild( el( 'span', 'seca-format seca-format--' + task.format, formatLabel( task.format ) ) );
			}

			if ( ! task.unlocked ) {
				button.appendChild( el( 'span', 'seca-task-tab-lock', '🔒' ) );
			} else if ( task.done ) {
				button.appendChild( el( 'span', 'seca-task-tab-lock', '✓' ) );
			}

			button.addEventListener( 'click', function () {
				openTask( index );
			} );

			nav.appendChild( button );
		} );
	}

	/**
	 * Recharge l'état de la room (progression, verrous).
	 *
	 * @return {Promise} Promesse.
	 */
	function refreshRoom() {
		return post( 'secura_get_room', { room_id: roomId } ).then( function ( data ) {
			room = data;

			renderNav();
			updateProgress();

			if ( data.lab ) {
				renderLab( data.lab );
			}

			return data;
		} );
	}

	/**
	 * Ouvre une tâche.
	 *
	 * @param {number} index Index de la tâche.
	 */
	function openTask( index ) {
		var task = room && room.tasks ? room.tasks[ index ] : null;

		if ( task && ! task.unlocked ) {
			toast( t( 'lock_task', 'Terminez la tâche précédente pour continuer.' ), true );
			return;
		}

		currentIndex = index;

		if ( statusNode ) {
			statusNode.textContent = '';
			statusNode.className = 'seca-task-status';
		}

		post( 'secura_get_task', { room_id: roomId, task: index } ).then( function ( data ) {
			renderTask( data.task );

			renderNav();

			if ( 'exam' === data.task.type && ! data.task.done ) {
				/* Le chronometre est deja parti : on affiche celui du
				   serveur (time_left) plutot que d'en demarrer un second.
				   Une tache d'examen n'est jamais servie sans chronometre
				   (le serveur refuse), sauf sur une copie deja terminee. */
				if ( data.task.time_left > 0 ) {
					afficherChronometre( data.task.time_left );
				} else {
					startExamTimer();
				}
			} else {
				stopTimer();
			}
		} ).catch( function ( error ) {
			/* L'examen n'est pas encore ouvert : le serveur ne livre pas
			   ses questions avant le chronometre. On l'ouvre, puis on le
			   recharge — c'est le serveur qui fixe l'heure de depart. */
			if ( 'exam_not_started' === error.code ) {
				post( 'secura_start_exam', { room_id: roomId, task: index } ).then( function () {
					openTask( index );
				} ).catch( function ( suite ) {
					toast( suite.message, true, suite.action );
				} );

				return;
			}

			toast( error.message, true, error.action );
		} );
	}

	/**
	 * Affiche l'en-tête d'une tâche : format, seuil, score, reprise d'examen.
	 *
	 * @param {Object} task Tâche.
	 */
	function renderTaskHeader( task ) {
		if ( ! headerNode ) {
			return;
		}

		headerNode.innerHTML = '';

		var left = el( 'div', 'seca-task-header-main' );

		left.appendChild( el( 'span', 'seca-format seca-format--' + ( task.format || 'qcm' ), formatLabel( task.format ) ) );

		if ( 'lesson' !== task.type ) {
			left.appendChild( el( 'span', 'seca-task-type', typeLabel( task.type ) ) );
		}

		if ( 'pratique' === task.format ) {
			left.appendChild( el( 'span', 'seca-task-goal', t( 'goal_practical', 'Objectif : mener la manipulation jusqu\'au bout.' ) ) );
		}

		headerNode.appendChild( left );

		var right = el( 'div', 'seca-task-header-side' );

		if ( task.questions && task.questions.length ) {
			right.appendChild( el( 'span', 'seca-task-score', task.score + ' %' ) );

			if ( task.threshold < 100 ) {
				right.appendChild( el( 'span', 'seca-task-threshold', t( 'threshold_short', 'Seuil' ) + ' ' + task.threshold + ' %' ) );
			}
		}

		if ( 'exam' === task.type ) {
			var retry = el( 'button', 'seca-btn seca-btn--small seca-btn--ghost', t( 'retry_exam', 'Recommencer l\'examen' ) );

			retry.type = 'button';

			retry.addEventListener( 'click', function () {
				retry.disabled = true;

				post( 'secura_start_exam', { room_id: roomId, task: currentIndex, force: '1' } ).then( function () {
					openTask( currentIndex );
				} ).catch( function ( error ) {
					retry.disabled = false;
					toast( error.message, true, error.action );
				} );
			} );

			right.appendChild( retry );
		}

		headerNode.appendChild( right );
	}

	/**
	 * Libellé lisible d'un type de tâche.
	 *
	 * @param {string} type Type.
	 * @return {string} Libellé.
	 */
	function typeLabel( type ) {
		if ( 'lesson' === type ) {
			return t( 'lesson', 'Leçon' );
		}

		if ( 'practice' === type ) {
			return t( 'practice', 'Entraînement' );
		}

		if ( 'test' === type ) {
			return t( 'test', 'Test d\'application' );
		}

		return t( 'exam', 'Examen' );
	}

	/**
	 * Affiche une tâche.
	 *
	 * @param {Object} task Tâche.
	 */
	function renderTask( task ) {
		renderTaskHeader( task );

		if ( contentNode ) {
			contentNode.innerHTML = task.content || '';
		}

		if ( questionsNode ) {
			questionsNode.innerHTML = '';
		}

		if ( actionsNode ) {
			actionsNode.innerHTML = '';
		}

		if ( terminalBox ) {
			terminalBox.hidden = true;
		}

		if ( terminalScreen ) {
			terminalScreen.innerHTML = '';
		}

		if ( task.terminal && task.terminal.steps > 0 ) {
			if ( terminalBox ) {
				terminalBox.hidden = false;
			}

			if ( terminalScreen ) {
				terminalScreen.appendChild( el( 'span', 'seca-term-cmd', task.terminal.intro || '$ ' ) );
			}
		}

		/* Leçon : pas de question, un bouton de validation. */
		if ( 'lesson' === task.type ) {
			var lessonButton = el( 'button', 'seca-btn seca-btn--primary', t( 'mark_done', 'J\'ai terminé cette leçon' ) );

			lessonButton.type = 'button';
			lessonButton.addEventListener( 'click', function () {
				lessonButton.disabled = true;

				post( 'secura_complete_lesson', { room_id: roomId, task: currentIndex } ).then( function () {
					toast( t( 'lesson_done', 'Leçon validée !' ) );

					return refreshRoom();
				} ).then( function () {
					openTask( currentIndex );
				} ).catch( function ( error ) {
					lessonButton.disabled = false;
					toast( error.message, true, error.action );
				} );
			} );

			if ( actionsNode ) {
				actionsNode.appendChild( lessonButton );
			}
		}

		( task.questions || [] ).forEach( function ( question, index ) {
			questionsNode.appendChild( renderQuestion( question, index, task ) );
		} );

		if ( task.done ) {
			showRecap( task );
		} else {
			addNextButton( task );
		}
	}

	/**
	 * Affiche une question.
	 *
	 * @param {Object} question Question.
	 * @param {number} index    Index.
	 * @param {Object} task     Tâche parente.
	 * @return {HTMLElement} Élément.
	 */
	function renderQuestion( question, index, task ) {
		var box = el( 'div', 'seca-question' );

		var head = el( 'div', 'seca-question-head' );

		head.appendChild( el( 'span', 'seca-question-index', String( index + 1 ) ) );
		head.appendChild( el( 'p', 'seca-question-text', question.question ) );
		head.appendChild( el( 'span', 'seca-question-xp', '+' + question.xp + ' XP' ) );

		box.appendChild( head );

		var mode = question.mode || 'text';
		var input = el( 'input', 'seca-answer-input' );
		var choices = [];

		input.type = 'text';
		input.autocomplete = 'off';
		input.setAttribute( 'aria-label', question.question );

		if ( 'choice' === mode ) {
			var list = el( 'div', 'seca-choices' );

			( question.choices || [] ).forEach( function ( choice ) {
				var row = el( 'label', 'seca-choice' );
				var radio = el( 'input', 'seca-choice-input' );

				radio.type = 'radio';
				radio.name = 'seca-choice-' + index;
				radio.value = choice;

				row.appendChild( radio );
				row.appendChild( el( 'span', 'seca-choice-label', choice ) );

				list.appendChild( row );
				choices.push( radio );
			} );

			box.appendChild( list );
		} else if ( 'action' === mode ) {
			box.appendChild( el( 'p', 'seca-action-note', t( 'action_note', "Realise l'action dans le terminal, puis confirme." ) ) );
		} else if ( 'solution' === mode ) {
			/* Probleme d'examen universitaire : l'eleve redige sa
			   reponse, et la correction officielle de l'ecole lui sera
			   montree juste apres. */
			input = document.createElement( 'textarea' );

			input.className = 'seca-answer-input seca-answer-textarea';
			input.rows = 6;
			input.autocomplete = 'off';
			input.setAttribute( 'aria-label', question.question );

			box.appendChild( el( 'p', 'seca-action-note', t( 'solution_note', "Redige ta reponse, puis affiche la correction officielle." ) ) );
			box.appendChild( input );
		} else {
			box.appendChild( input );
		}

		if ( question.solved ) {
			input.disabled = true;
			input.value = t( 'solved', 'Validée' );

			choices.forEach( function ( radio ) {
				radio.disabled = true;
			} );

			box.classList.add( 'is-correct' );
		}

		var actions = el( 'div', 'seca-question-actions' );

		var submit = el( 'button', 'seca-btn seca-btn--primary', 'solution' === mode
			? t( 'see_solution', 'Voir la correction officielle' )
			: t( 'validate', 'Valider' ) );

		submit.type = 'button';

		var hintButton = el( 'button', 'seca-btn seca-btn--ghost', t( 'hint', 'Indice' ) );

		hintButton.type = 'button';

		if ( question.solved || 'exam' === task.type ) {
			hintButton.disabled = true;
		}

		if ( question.solved ) {
			submit.disabled = true;
		}

		function feedback( message, good ) {
			var node = el( 'p', 'seca-feedback ' + ( good ? 'is-good' : 'is-bad' ), message );

			box.appendChild( node );
		}

		function explain( text ) {
			if ( ! text ) {
				return;
			}

			var node = el( 'div', 'seca-explanation' );

			node.appendChild( el( 'strong', '', t( 'explanation', 'Explication' ) ) );
			node.appendChild( document.createTextNode( text ) );

			box.appendChild( node );
		}

		submit.addEventListener( 'click', function () {
			var value = '';

			if ( 'action' === mode ) {
				value = 'done';
			} else if ( 'choice' === mode ) {
				var picked = '';

				choices.forEach( function ( radio ) {
					if ( radio.checked ) {
						picked = radio.value;
					}
				} );

				if ( ! picked ) {
					toast( t( 'choose_answer', 'Choisis une reponse avant de valider.' ), true );
					return;
				}

				value = picked;
			} else {
				value = input.value;

				if ( ! value.trim() ) {
					input.focus();
					return;
				}

				if ( 'solution' === mode && value.trim().length < 10 ) {
					toast( t( 'answer_too_short', 'Ecris ta reponse (au moins quelques mots) avant d\'afficher la correction.' ), true );
					return;
				}
			}

			submit.disabled = true;

			post( 'secura_validate_answer', {
				room_id: roomId,
				task: currentIndex,
				question: index,
				answer: value
			} ).then( function ( data ) {
				if ( data.correct ) {
					box.classList.remove( 'is-wrong' );
					box.classList.add( 'is-correct' );
					input.disabled = true;

					choices.forEach( function ( radio ) {
						radio.disabled = true;
					} );

					feedback( data.message, true );

					explain( data.explanation );

					syncDashboard( data );

					if ( data.level_up && data.level ) {
						showLevelUp( data.level );
					} else if ( data.points > 0 ) {
						toast( '+' + data.points + ' XP' );
					}

					if ( data.exam ) {
						showExamResult( data.exam );
					}

					if ( data.room_complete ) {
						confetti();
						toast( t( 'room_complete', 'Room terminée, bravo !' ) );
					}

					refreshRoom().then( function () {
						if ( data.task_done ) {
							post( 'secura_get_task', { room_id: roomId, task: currentIndex, reveal: '1' } ).then( function ( refreshed ) {
								renderTask( refreshed.task );
							} );
						}
					} );
				} else {
					box.classList.add( 'is-wrong' );
					submit.disabled = false;

					feedback( data.message, false );

					/* Question ouverte : on ne note pas la prose a la place
					   de l'eleve, on lui montre la correction officielle et on
					   lui demande de se positionner. Sa declaration, et elle
					   seule, valide la question. */
					if ( data.solution ) {
						showSolution( data.solution, data.explanation );
					}

					if ( data.hint ) {
						showHint( data.hint );
						hintButton.disabled = true;
					}
				}
			} ).catch( function ( error ) {
				submit.disabled = false;
				feedback( error.message, false );

				if ( 'expired' === error.code ) {
					stopTimer();
					showExamResult( { score: 0, passed: false, expired: true } );
				}
			} );
		} );

		function showSolution( solution, explanation ) {
			if ( ! solution || box.querySelector( '.seca-solution-box' ) ) {
				return;
			}

			var wrap = el( 'div', 'seca-solution-box' );

			wrap.appendChild( el( 'strong', '', t( 'solution_label', 'Corrigé officiel' ) ) );

			if ( explanation ) {
				var off = el( 'div', 'seca-solution-text' );
				off.innerHTML = explanation;
				wrap.appendChild( off );
			}

			if ( solution.message ) {
				wrap.appendChild( el( 'p', 'seca-solution-note', solution.message ) );
			}

			/* Les concepts attendus : ce qui manque, nommement. C'est la
			   seule information qui aide l'eleve a progresser sans lui
			   donner la reponse. */
			if ( solution.manquants && solution.manquants.length ) {
				var manque = el( 'p', 'seca-solution-note', t( 'missing_concepts', 'Concepts attendus non retrouvés' ) + ' : ' + solution.manquants.join( ', ' ) );
				wrap.appendChild( manque );
			}

			/* Auto-evaluation : uniquement quand la machine ne peut pas
			   juger. Deux boutons, et le meme poids pour les deux : on ne
			   recompense pas un mensonge, on demande l'honnetete. */
			if ( solution.a_confirmer ) {
				var row = el( 'div', 'seca-solution-actions' );

				var oui = el( 'button', 'seca-button seca-button-small', t( 'confirm_had_it', "J'avais la bonne réponse" ) );
				oui.type = 'button';
				oui.addEventListener( 'click', function () {
					oui.disabled = true;
					non.disabled = true;
					submit.click();
				} );

				var non = el( 'button', 'seca-button seca-button-ghost seca-button-small', t( 'confirm_missed', "Je ne l'avais pas" ) );
				non.type = 'button';
				non.addEventListener( 'click', function () {
					oui.disabled = true;
					non.disabled = true;
					feedback( t( 'go_review', 'Relisez le corrigé, puis revenez : la question restera à faire.' ), false );
				} );

				row.appendChild( oui );
				row.appendChild( non );
				wrap.appendChild( row );
			}

			box.appendChild( wrap );
		}

		function showHint( text ) {
			if ( box.querySelector( '.seca-hint-box' ) ) {
				return;
			}

			var node = el( 'div', 'seca-hint-box' );

			node.appendChild( el( 'strong', '', t( 'hint_label', 'Indice :' ) ) );
			node.appendChild( document.createTextNode( ' ' + text ) );

			box.appendChild( node );
		}

		hintButton.addEventListener( 'click', function () {
			hintButton.disabled = true;

			post( 'secura_hint', {
				room_id: roomId,
				task: currentIndex,
				question: index
			} ).then( function ( data ) {
				showHint( data.hint );
			} ).catch( function ( error ) {
				hintButton.disabled = false;
				toast( error.message, true, error.action );
			} );
		} );

		input.addEventListener( 'keydown', function ( event ) {
			if ( 'Enter' === event.key ) {
				event.preventDefault();
				submit.click();
			}
		} );

		actions.appendChild( submit );
		actions.appendChild( hintButton );

		box.appendChild( actions );

		return box;
	}

	/**
	 * Ajoute le bouton « tâche suivante ».
	 *
	 * @param {Object} task Tâche courante.
	 */
	function addNextButton( task ) {
		if ( ! actionsNode || ! room ) {
			return;
		}

		var next = room.tasks[ currentIndex + 1 ];

		if ( ! next ) {
			return;
		}

		var button = el( 'button', 'seca-btn', t( 'next_task', 'Tâche suivante' ) );

		button.type = 'button';
		button.disabled = ! next.unlocked;

		button.addEventListener( 'click', function () {
			openTask( currentIndex + 1 );
		} );

		actionsNode.appendChild( button );
	}

	/**
	 * Affiche le récapitulatif pédagogique d'une tâche terminée.
	 *
	 * @param {Object} task Tâche.
	 */
	function showRecap( task ) {
		if ( ! actionsNode ) {
			return;
		}

		var result = el( 'div', 'seca-result' );

		var solved = ( task.questions || [] ).filter( function ( question ) {
			return question.solved;
		} ).length;

		var total = ( task.questions || [] ).length;
		var percent = total > 0 ? Math.round( ( solved / total ) * 100 ) : 100;

		result.classList.add( 'exam' === task.type ? ( percent >= task.pass_score ? 'is-pass' : 'is-fail' ) : 'is-pass' );
		result.appendChild( el( 'div', 'seca-result-score', percent + ' %' ) );
		result.appendChild( el( 'div', 'seca-result-title', t( 'task_done', 'Tâche réussie' ) ) );
		result.appendChild( el( 'p', 'seca-result-sub', t( 'score', 'Score' ) + ' : ' + solved + '/' + total ) );

		if ( task.threshold < 100 ) {
			result.appendChild( el( 'p', 'seca-result-sub', t( 'threshold', 'Seuil' ) + ' : ' + task.threshold + ' %' ) );
		}

		actionsNode.appendChild( result );

		addNextButton( task );
	}

	/**
	 * Affiche le résultat d'un examen.
	 *
	 * @param {Object} exam Résultat serveur.
	 */
	function showExamResult( exam ) {
		if ( ! actionsNode ) {
			return;
		}

		var result = el( 'div', 'seca-result ' + ( exam.passed ? 'is-pass' : 'is-fail' ) );

		if ( exam.expired ) {
			result.appendChild( el( 'div', 'seca-result-score', '⏱' ) );
			result.appendChild( el( 'div', 'seca-result-title', t( 'expired', 'Temps écoulé' ) ) );
			result.appendChild( el( 'p', 'seca-result-sub', t( 'time_up_hint', 'Relance l\'examen pour réessayer.' ) ) );

			actionsNode.appendChild( result );

			return;
		}

		result.appendChild( el( 'div', 'seca-result-score', exam.score + ' %' ) );

		if ( exam.medal ) {
			result.appendChild( el( 'div', 'seca-result-medal', 'gold' === exam.medal ? '🥇' : ( 'silver' === exam.medal ? '🥈' : '🥉' ) ) );
		}

		result.appendChild( el( 'div', 'seca-result-title', exam.passed ? t( 'passed', 'Examen réussi !' ) : t( 'failed', 'Seuil non atteint' ) ) );
		result.appendChild( el( 'p', 'seca-result-sub', t( 'score', 'Score' ) + ' : ' + exam.correct + '/' + exam.total + ' · ' + t( 'pass', 'Seuil' ) + ' ' + exam.threshold + ' %' ) );

		actionsNode.appendChild( result );
	}

	/* ---------------------------------------------------------- Terminal */

	if ( terminalForm ) {
		terminalForm.addEventListener( 'submit', function ( event ) {
			event.preventDefault();

			var command = terminalInput.value.trim();

			if ( ! command ) {
				return;
			}

			terminalInput.value = '';
			terminalInput.disabled = true;

			commandHistory.push( command );
			historyIndex = -1;

			post( 'secura_terminal', {
				room_id: roomId,
				task: currentIndex,
				command: command
			} ).then( function ( data ) {
				appendTerminal( 'seca-term-cmd', '$ ' + command );
				appendTerminal( data.matched ? 'seca-term-ok' : 'seca-term-err', data.output );

				if ( data.hint ) {
					appendTerminal( 'seca-term-hint', '💡 ' + data.hint );
				}
			} ).catch( function ( error ) {
				appendTerminal( 'seca-term-err', error.message );
			} ).then( function () {
				terminalInput.disabled = false;
				terminalInput.focus();
			} );
		} );
	}

	if ( terminalInput ) {
		terminalInput.addEventListener( 'keydown', function ( event ) {
			if ( 'ArrowUp' === event.key ) {
				event.preventDefault();

				if ( commandHistory.length ) {
					historyIndex = ( historyIndex < 0 ) ? commandHistory.length - 1 : Math.max( 0, historyIndex - 1 );
					terminalInput.value = commandHistory[ historyIndex ];
				}

				return;
			}

			if ( 'ArrowDown' === event.key ) {
				event.preventDefault();

				if ( commandHistory.length ) {
					historyIndex = ( historyIndex < 0 ) ? -1 : Math.min( commandHistory.length - 1, historyIndex + 1 );

					terminalInput.value = historyIndex < 0 ? '' : commandHistory[ historyIndex ];
				}

				return;
			}

			if ( 'c' === event.key && event.ctrlKey ) {
				event.preventDefault();
				terminalInput.value = '';
				appendTerminal( 'seca-term-err', '^C' );

				return;
			}

			if ( 'Tab' === event.key ) {
				var value = terminalInput.value;

				if ( value ) {
					event.preventDefault();
					terminalInput.value = value + ' ';
				}
			}
		} );
	}

	/* ------------------------------------------------------------- Lab */

	/**
	 * Met à jour l'affichage du lab à partir d'un statut serveur.
	 *
	 * @param {Object} status Statut.
	 */
	function renderLab( status ) {
		if ( ! labBox ) {
			return;
		}

		if ( ! status || ! status.enabled ) {
			labBox.hidden = true;

			return;
		}

		labBox.hidden = false;

		if ( labState ) {
			labState.textContent = labStateLabel( status.state );
			labState.className = 'seca-lab-state is-' + ( status.state || 'idle' );
		}

		if ( labMessage ) {
			labMessage.textContent = status.message || '';
		}

		if ( labTarget ) {
			labTarget.textContent = status.target ? ( t( 'target', 'Cible' ) + ' : ' + status.target ) : '';
			labTarget.hidden = ! status.target;
		}

		if ( labStart ) {
			labStart.hidden = 'running' === status.state;
			labStart.disabled = 'running' === status.state;
		}

		if ( labStop ) {
			labStop.hidden = 'running' !== status.state;
		}

		var live = 'running' === status.state;

		if ( terminalBadge ) {
			terminalBadge.textContent = live ? t( 'terminal_live', 'machine réelle' ) : t( 'terminal_simulated', 'simulé' );
			terminalBadge.className = 'seca-terminal-badge' + ( live ? ' is-live' : '' );
		}

		if ( terminalNote ) {
			terminalNote.textContent = live
				? t( 'terminal_note_live', 'Machine réelle isolée : les commandes s\'exécutent dans un conteneur éphémère, sans impact sur l\'hébergement.' )
				: t( 'terminal_note_simulated', 'Terminal simulé : aucune machine réelle n\'est exécutée.' );
		}
	}

	/**
	 * Libellé lisible d'un état de lab.
	 *
	 * @param {string} state État.
	 * @return {string} Libellé.
	 */
	function labStateLabel( state ) {
		if ( 'running' === state ) {
			return t( 'lab_running', 'en marche' );
		}

		if ( 'expired' === state ) {
			return t( 'lab_expired', 'expirée' );
		}

		if ( 'simulated' === state ) {
			return t( 'lab_simulated', 'simulée' );
		}

		if ( 'error' === state ) {
			return t( 'lab_error', 'erreur' );
		}

		return t( 'lab_idle', 'arrêtée' );
	}

	/**
	 * Demande le statut du lab au serveur.
	 */
	function refreshLab() {
		if ( ! labBox ) {
			return;
		}

		post( 'secura_lab_status', { room_id: roomId } ).then( function ( status ) {
			renderLab( status );
		} ).catch( function () {} );
	}

	if ( labStart ) {
		labStart.addEventListener( 'click', function () {
			labStart.disabled = true;

			post( 'secura_lab_start', { room_id: roomId } ).then( function ( result ) {
				renderLab( result );
				toast( result.message || '' );
			} ).catch( function ( error ) {
				toast( error.message, true, error.action );
				refreshLab();
			} );
		} );
	}

	if ( labStop ) {
		labStop.addEventListener( 'click', function () {
			post( 'secura_lab_stop', { room_id: roomId } ).then( function ( status ) {
				renderLab( status );
			} ).catch( function ( error ) {
				toast( error.message, true, error.action );
			} );
		} );
	}

	/**
	 * Ajoute une ligne dans le terminal.
	 *
	 * @param {string} cls  Classe.
	 * @param {string} text Texte.
	 */
	function appendTerminal( cls, text ) {
		if ( ! terminalScreen ) {
			return;
		}

		terminalScreen.appendChild( el( 'span', cls, text + '\n' ) );
		terminalScreen.scrollTop = terminalScreen.scrollHeight;
	}

	/* -------------------------------------------------------- Chronomètre */

	/**
	 * Démarre le chronomètre d'examen (serveur autoritaire).
	 */
	function startExamTimer() {
		post( 'secura_start_exam', { room_id: roomId, task: currentIndex } ).then( function ( data ) {
			afficherChronometre( data.time_left );
		} ).catch( function () {
			/* Le serveur refusera toute réponse si le temps est écoulé. */
		} );
	}

	/**
	 * Affiche le compte a rebours serveur.
	 *
	 * @param {number} restant Secondes restantes.
	 */
	function afficherChronometre( restant ) {
		stopTimer();

		timeLeft = parseInt( restant, 10 ) || 0;

		if ( ! timeLeft ) {
			return;
		}

		var node = el( 'span', 'seca-timer' );

		node.setAttribute( 'data-seca-timer', '1' );

		var head = app.querySelector( '.seca-room-head-main' );

		if ( head ) {
			head.appendChild( node );
		}

		timerHandle = window.setInterval( function () {
			timeLeft -= 1;

			if ( timeLeft <= 0 ) {
				timeLeft = 0;
				stopTimer();

				if ( statusNode ) {
					statusNode.textContent = t( 'expired', 'Temps écoulé' );
					statusNode.className = 'seca-task-status is-bad';
				}
			}

			updateTimer( node );
		}, 1000 );

		updateTimer( node );
	}

	/**
	 * Met à jour l'affichage du chronomètre.
	 *
	 * @param {HTMLElement} node Élément.
	 */
	function updateTimer( node ) {
		var minutes = Math.floor( timeLeft / 60 );
		var seconds = timeLeft % 60;

		node.textContent = '⏱ ' + minutes + ':' + ( seconds < 10 ? '0' : '' ) + seconds;

		if ( timeLeft <= 60 ) {
			node.classList.remove( 'is-safe' );
		}
	}

	/**
	 * Arrête le chronomètre.
	 */
	function stopTimer() {
		if ( timerHandle ) {
			window.clearInterval( timerHandle );
			timerHandle = null;
		}

		var node = app.querySelector( '[data-seca-timer]' );

		if ( node && node.parentNode ) {
			node.parentNode.removeChild( node );
		}
	}

	/* ------------------------------------------------------------- Début */

	bindLanguageSwitch();

	refreshRoom().then( function () {
		openTask( 0 );
	} );
} )();
