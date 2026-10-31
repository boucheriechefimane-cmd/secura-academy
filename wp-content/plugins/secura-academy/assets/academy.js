/**
 * Secura Academy — interactions du tableau de bord.
 *
 * Chargement d'une room, validation des réponses en AJAX, mise à jour
 * de la progression, des XP et des trophées.
 */
( function () {
	'use strict';

	var cfg = window.SecuraAcademy || {};
	var i18n = cfg.i18n || {};
	var levels = Array.isArray( cfg.levels ) ? cfg.levels : [];

	var dashboard = document.querySelector( '[data-secura-dashboard]' );

	if ( ! dashboard ) {
		return;
	}

	var panel = document.querySelector( '[data-sa-panel]' );

	if ( ! panel ) {
		return;
	}

	var panelTitle = panel.querySelector( '[data-sa-panel-title]' );
	var panelEyebrow = panel.querySelector( '[data-sa-panel-eyebrow]' );
	var panelContent = panel.querySelector( '[data-sa-panel-content]' );
	var panelSteps = panel.querySelector( '[data-sa-panel-steps]' );
	var panelStatus = panel.querySelector( '[data-sa-panel-status]' );

	var lastFocused = null;
	var currentRoom = null;

	/**
	 * Traduit une clé de langue.
	 *
	 * @param {string} key     Clé.
	 * @param {string} fallback Valeur de repli.
	 * @return {string} Libellé traduit.
	 */
	function t( key, fallback ) {
		return i18n[ key ] || fallback || key;
	}

	/**
	 * Échappe une chaîne pour une insertion en HTML.
	 *
	 * @param {string} value Valeur.
	 * @return {string} Valeur échappée.
	 */
	function escapeHtml( value ) {
		return String( value === undefined || value === null ? '' : value )
			.replace( /&/g, '&amp;' )
			.replace( /</g, '&lt;' )
			.replace( />/g, '&gt;' )
			.replace( /"/g, '&quot;' )
			.replace( /'/g, '&#039;' );
	}

	/**
	 * Envoie une requête AJAX à WordPress.
	 *
	 * @param {string} action Action WordPress.
	 * @param {Object} data   Données additionnelles.
	 * @return {Promise<Object>} Réponse JSON décodée.
	 */
	function request( action, data ) {
		var body = new window.FormData();
		body.append( 'action', action );
		body.append( 'nonce', cfg.nonce || '' );

		Object.keys( data || {} ).forEach( function ( key ) {
			body.append( key, data[ key ] );
		} );

		return window.fetch( cfg.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			body: body
		} ).then( function ( response ) {
			return response.json().catch( function () {
				throw new Error( 'bad_json' );
			} );
		} );
	}

	/**
	 * Lit le total de XP affiché.
	 *
	 * @return {number} XP.
	 */
	function readXp() {
		var node = dashboard.querySelector( '[data-sa-xp]' );

		if ( ! node ) {
			return 0;
		}

		return parseInt( node.textContent.replace( /[^0-9]/g, '' ), 10 ) || 0;
	}

	/**
	 * Détermine le niveau correspondant à un total de XP.
	 *
	 * @param {number} xp XP accumulés.
	 * @return {Object|null} Niveau.
	 */
	function levelForXp( xp ) {
		var found = null;

		levels.forEach( function ( level ) {
			if ( null === level.max || ( xp >= level.min && xp <= level.max ) ) {
				found = level;
			}
		} );

		return found;
	}

	/**
	 * Met à jour l'affichage des XP, du niveau et de la progression.
	 *
	 * @param {number} xp Nouveau total de XP.
	 */
	function updateXpDisplay( xp ) {
		var xpNode = dashboard.querySelector( '[data-sa-xp]' );

		if ( xpNode ) {
			xpNode.textContent = String( xp );
		}

		var level = levelForXp( xp );

		if ( level ) {
			var labelNode = dashboard.querySelector( '[data-sa-level]' );

			if ( labelNode ) {
				labelNode.textContent = 'Niveau ' + level.number + ' — ' + level.label;
			}

			var range = Math.max( 1, ( level.max === null ? level.min + 1 : level.max + 1 ) - level.min );
			var percent = Math.min( 100, Math.max( 0, Math.round( ( ( xp - level.min ) / range ) * 100 ) ) );
			var bar = dashboard.querySelector( '[data-sa-xpbar]' );

			if ( bar ) {
				bar.style.width = percent + '%';
				bar.setAttribute( 'aria-valuenow', String( percent ) );
			}

			var hint = dashboard.querySelector( '[data-sa-level-hint]' );

			if ( hint ) {
				hint.textContent = level.max === null
					? 'Niveau maximum atteint'
					: Math.max( 0, level.max + 1 - xp ) + ' XP avant le niveau suivant';
			}
		}
	}

	/**
	 * Recalcule l'avancement global du parcours à partir des cards.
	 */
	function updateProgressDisplay() {
		var cards = dashboard.querySelectorAll( '.secura-room-card' );
		var done = dashboard.querySelectorAll( '.secura-room-card.is-done' ).length;
		var total = cards.length;

		var counter = dashboard.querySelector( '[data-sa-rooms-done]' );

		if ( counter ) {
			counter.textContent = done + ' / ' + total;
		}

		var percent = total > 0 ? Math.round( ( done / total ) * 100 ) : 0;
		var fill = dashboard.querySelector( '[data-sa-progress]' );

		if ( fill ) {
			fill.style.width = percent + '%';
			fill.setAttribute( 'aria-valuenow', String( percent ) );
		}

		var text = dashboard.querySelector( '[data-sa-progress-text]' );

		if ( text ) {
			text.textContent = done + ' room(s) terminée(s) sur ' + total + '.';
		}
	}

	/**
	 * Ajoute les nouveaux trophées à la collection affichée.
	 *
	 * @param {Array} trophies Nouveaux trophées.
	 */
	function addTrophies( trophies ) {
		if ( ! Array.isArray( trophies ) || ! trophies.length ) {
			return;
		}

		var list = dashboard.querySelector( '[data-sa-trophies]' );

		if ( ! list ) {
			return;
		}

		var empty = list.querySelector( '.is-empty' );

		if ( empty ) {
			empty.parentNode.removeChild( empty );
		}

		trophies.forEach( function ( trophy ) {
			var item = document.createElement( 'li' );
			item.className = 'secura-trophy';

			var icon = document.createElement( 'span' );
			icon.className = 'secura-trophy-icon';
			icon.setAttribute( 'aria-hidden', 'true' );
			icon.textContent = trophy.icon || '🏅';

			var body = document.createElement( 'span' );
			body.className = 'secura-trophy-body';

			var name = document.createElement( 'strong' );
			name.textContent = trophy.name || '';

			var description = document.createElement( 'span' );
			description.textContent = trophy.description || '';

			body.appendChild( name );
			body.appendChild( description );
			item.appendChild( icon );
			item.appendChild( body );
			list.appendChild( item );
		} );

		var counter = dashboard.querySelector( '[data-sa-trophies-count]' );

		if ( counter ) {
			counter.textContent = String( list.querySelectorAll( '.secura-trophy:not(.is-empty)' ).length );
		}
	}

	/**
	 * Ouvre le panneau d'une room.
	 *
	 * @param {HTMLElement} card Card cliquée.
	 */
	function openRoom( card ) {
		var roomId = parseInt( card.getAttribute( 'data-sa-room' ), 10 );

		if ( ! roomId ) {
			return;
		}

		if ( 'true' === card.getAttribute( 'aria-disabled' ) ) {
			return;
		}

		lastFocused = document.activeElement;
		currentRoom = card;

		panel.hidden = false;
		document.body.style.overflow = 'hidden';

		panelTitle.textContent = t( 'loading', 'Chargement…' );
		panelEyebrow.textContent = '';
		panelContent.innerHTML = '';
		panelSteps.innerHTML = '';
		panelSteps.hidden = true;
		panelStatus.textContent = '';

		var focusable = panel.querySelector( '.secura-panel-close' );

		if ( focusable ) {
			focusable.focus();
		}

		request( 'secura_get_room', { room_id: roomId } )
			.then( function ( response ) {
				if ( ! response || ! response.success ) {
					var message = response && response.data && response.data.message
						? response.data.message
						: t( 'genericError', 'Une erreur est survenue. Réessayez.' );
					panelTitle.textContent = message;
					return;
				}

				renderRoom( response.data );
			} )
			.catch( function () {
				panelTitle.textContent = t( 'networkError', 'Connexion impossible. Vérifiez votre réseau.' );
			} );
	}

	/**
	 * Remplit le panneau avec le contenu d'une room.
	 *
	 * @param {Object} data Données de la room.
	 */
	function renderRoom( data ) {
		var meta = [];

		if ( data.difficulty ) {
			meta.push( data.difficulty );
		}

		if ( data.duration ) {
			meta.push( data.duration + ' min' );
		}

		if ( data.xpBonus ) {
			meta.push( '+' + data.xpBonus + ' XP' );
		}

		panelEyebrow.textContent = meta.join( ' · ' );
		panelTitle.textContent = data.title || '';
		panelContent.innerHTML = data.content || '';
		panelSteps.hidden = false;
		panelSteps.innerHTML = '';

		( data.steps || [] ).forEach( function ( step ) {
			panelSteps.appendChild( buildStep( step ) );
		} );

		var firstInput = panelSteps.querySelector( 'input.secura-step-input' );

		if ( firstInput ) {
			firstInput.focus();
		}
	}

	/**
	 * Construit le bloc d'une étape.
	 *
	 * @param {Object} step Étape (sans la réponse attendue).
	 * @return {HTMLElement} Élément DOM.
	 */
	function buildStep( step ) {
		var wrapper = document.createElement( 'form' );
		wrapper.className = 'secura-step' + ( step.solved ? ' is-solved' : '' );
		wrapper.setAttribute( 'data-step', String( step.index ) );

		var head = document.createElement( 'div' );
		head.className = 'secura-step-head';

		var title = document.createElement( 'p' );
		title.className = 'secura-step-title';
		title.textContent = t( 'stepsTitle', 'Étapes de la room' ) + ' ' + ( step.index + 1 );

		var xp = document.createElement( 'span' );
		xp.className = 'secura-step-xp';
		xp.textContent = step.solved ? t( 'solved', 'Validée' ) : '+' + step.xp + ' XP';

		head.appendChild( title );
		head.appendChild( xp );

		var question = document.createElement( 'p' );
		question.className = 'secura-step-question';
		question.textContent = step.question;

		var form = document.createElement( 'div' );
		form.className = 'secura-step-form';

		var input = document.createElement( 'input' );
		input.type = 'text';
		input.className = 'secura-step-input';
		input.autocomplete = 'off';
		input.setAttribute( 'aria-label', t( 'answerLabel', 'Votre réponse' ) );
		input.placeholder = t( 'answerLabel', 'Votre réponse' );

		var button = document.createElement( 'button' );
		button.type = 'submit';
		button.className = 'secura-btn seca-btn--primary';
		button.textContent = t( 'validate', 'Valider' );

		if ( step.solved ) {
			input.disabled = true;
			button.disabled = true;
		}

		form.appendChild( input );
		form.appendChild( button );

		var hint = document.createElement( 'p' );
		hint.className = 'secura-hint';
		hint.hidden = true;

		if ( step.hint ) {
			var toggle = document.createElement( 'button' );
			toggle.type = 'button';
			toggle.className = 'secura-hint-toggle';
			toggle.textContent = t( 'hint', "Afficher l'indice" );

			toggle.addEventListener( 'click', function () {
				hint.hidden = ! hint.hidden;
				hint.textContent = step.hint;
				toggle.textContent = hint.hidden ? t( 'hint', "Afficher l'indice" ) : t( 'hideHint', 'Masquer l’indice' );
			} );

			wrapper.appendChild( head );
			wrapper.appendChild( question );
			wrapper.appendChild( form );
			wrapper.appendChild( toggle );
			wrapper.appendChild( hint );
		} else {
			wrapper.appendChild( head );
			wrapper.appendChild( question );
			wrapper.appendChild( form );
		}

		wrapper.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			submitStep( wrapper, input, button );
		} );

		return wrapper;
	}

	/**
	 * Envoie une réponse au serveur et met à jour l'interface.
	 *
	 * @param {HTMLElement} step   Bloc d'étape.
	 * @param {HTMLInputElement} input  Champ de saisie.
	 * @param {HTMLButtonElement} button Bouton de validation.
	 */
	function submitStep( step, input, button ) {
		var answer = input.value.trim();

		if ( ! answer ) {
			input.focus();
			return;
		}

		var index = parseInt( step.getAttribute( 'data-step' ), 10 );

		button.disabled = true;
		button.textContent = t( 'loading', 'Chargement…' );

		request( 'secura_validate_answer', {
			room_id: currentRoom ? currentRoom.getAttribute( 'data-sa-room' ) : '',
			question: index,
			answer: answer
		} )
			.then( function ( response ) {
				button.disabled = false;
				button.textContent = t( 'validate', 'Valider' );

				if ( ! response || ! response.success ) {
					var message = response && response.data && response.data.message
						? response.data.message
						: t( 'genericError', 'Une erreur est survenue. Réessayez.' );
					showFeedback( step, message, false );
					return;
				}

				var data = response.data;

				if ( data.correct ) {
					showFeedback( step, data.message, true );
					step.classList.add( 'is-solved' );
					input.disabled = true;
					button.disabled = true;

					var xpNode = step.querySelector( '.secura-step-xp' );

					if ( xpNode ) {
						xpNode.textContent = t( 'solved', 'Validée' );
					}

					updateXpDisplay( typeof data.total_xp === 'number' ? data.total_xp : readXp() );
					addTrophies( data.new_trophies );

					if ( data.room_completed ) {
						markRoomCompleted();
					}
				} else {
					showFeedback( step, data.message, false );
					input.select();
				}
			} )
			.catch( function () {
				button.disabled = false;
				button.textContent = t( 'validate', 'Valider' );
				showFeedback( step, t( 'networkError', 'Connexion impossible. Vérifiez votre réseau.' ), false );
			} );
	}

	/**
	 * Affiche le retour de validation d'une étape.
	 *
	 * @param {HTMLElement} step    Bloc d'étape.
	 * @param {string}      message Message.
	 * @param {boolean}     correct Succès ou non.
	 */
	function showFeedback( step, message, correct ) {
		var feedback = step.querySelector( '.secura-step-feedback' );

		if ( ! feedback ) {
			feedback = document.createElement( 'p' );
			feedback.className = 'secura-step-feedback';
			step.appendChild( feedback );
		}

		feedback.textContent = message;
		feedback.classList.toggle( 'is-correct', !! correct );
		feedback.classList.toggle( 'is-wrong', ! correct );
	}

	/**
	 * Marque la room courante comme terminée et déverrouille la suivante.
	 */
	function markRoomCompleted() {
		if ( ! currentRoom ) {
			return;
		}

		currentRoom.classList.remove( 'is-progress', 'is-current' );
		currentRoom.classList.add( 'is-done' );

		var status = currentRoom.querySelector( '.secura-room-status' );

		if ( status ) {
			status.textContent = 'Terminée';
		}

		var next = currentRoom.nextElementSibling;

		if ( next && next.classList.contains( 'secura-room-card' ) && next.classList.contains( 'is-locked' ) ) {
			next.classList.remove( 'is-locked' );
			next.setAttribute( 'aria-disabled', 'false' );

			var nextStatus = next.querySelector( '.secura-room-status' );

			if ( nextStatus ) {
				nextStatus.textContent = 'À faire';
			}
		}

		updateProgressDisplay();
	}

	/**
	 * Ferme le panneau et rend le focus à l'élément d'origine.
	 */
	function closePanel() {
		panel.hidden = true;
		document.body.style.overflow = '';

		if ( lastFocused && typeof lastFocused.focus === 'function' ) {
			lastFocused.focus();
		}

		currentRoom = null;
	}

	/* ---------------------------------------------------------------------
	 * Écouteurs
	 * ------------------------------------------------------------------ */

	dashboard.addEventListener( 'click', function ( event ) {
		var card = event.target.closest ? event.target.closest( '.secura-room-card[data-sa-room]' ) : null;

		if ( ! card ) {
			return;
		}

		if ( 'true' === card.getAttribute( 'aria-disabled' ) ) {
			return;
		}

		openRoom( card );
	} );

	dashboard.addEventListener( 'keydown', function ( event ) {
		if ( 'Enter' !== event.key && ' ' !== event.key ) {
			return;
		}

		var card = event.target.closest ? event.target.closest( '.secura-room-card[data-sa-room]' ) : null;

		if ( ! card ) {
			return;
		}

		event.preventDefault();
		openRoom( card );
	} );

	panel.addEventListener( 'click', function ( event ) {
		if ( event.target.closest && event.target.closest( '[data-sa-close]' ) ) {
			closePanel();
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && ! panel.hidden ) {
			closePanel();
		}
	} );

	updateProgressDisplay();
} )();
