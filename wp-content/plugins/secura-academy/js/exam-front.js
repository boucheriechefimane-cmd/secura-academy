/**
 * Front JS pour les examens chronométrés Secura Academy.
 * Appelle l'API AJAX : secura_start_exam, secura_exam_time, secura_exam_submit.
 */

jQuery( function ( $ ) {
	'use strict';

	var examState = {}; // room_id => { questions, timeRemaining, timerInterval }

	function formatTime( seconds ) {
		var m = Math.floor( seconds / 60 );
		var s = seconds % 60;
		return ( m < 10 ? '0' : '' ) + m + ':' + ( s < 10 ? '0' : '' ) + s;
	}

	function examMessage( roomId, message, type ) {
		var $msg = $( '#seca-exam-message-' + roomId );
		if ( $msg.length === 0 ) {
			return;
		}
		var cls = type === 'error' ? 'seca-exam-error' : type === 'success' ? 'seca-exam-success' : 'seca-exam-info';
		$msg.removeClass().addClass( 'seca-exam-message ' + cls ).text( message );
	}

	function examStart( roomId ) {
		examMessage( roomId, secaExam.startMsg + '...', 'info' );

		$.post( secaExam.ajaxUrl, {
			action: 'secura_start_exam',
			room_id: roomId,
			nonce: secaExam.nonce
		}, function ( resp ) {
			if ( resp.success ) {
				var data = resp.data;
				examState[ roomId ] = {
					questions: data.questions,
					timeRemaining: data.time_remaining,
					timerInterval: null
				};

				examMessage( roomId, data.message, 'success' );
				$( '#seca-exam-start-' + roomId ).prop( 'disabled', true ).addClass( 'seca-hidden' );
				$( '#seca-exam-submit-' + roomId ).prop( 'disabled', false ).removeClass( 'seca-hidden' );
				$( '#seca-exam-timer-display-' + roomId ).show();
				$( '#seca-exam-questions-' + roomId ).show();

				renderQuestions( roomId );
				startTimer( roomId );
			} else {
				examMessage( roomId, resp.data && resp.data.message ? resp.data.message : 'Erreur inconnue.', 'error' );
			}
		}).fail( function () {
			examMessage( roomId, 'Erreur de connexion au serveur.', 'error' );
		});
	}

	function startTimer( roomId ) {
		var state = examState[ roomId ];
		if ( ! state ) {
			return;
		}

		updateTimerDisplay( roomId );

		state.timerInterval = setInterval( function () {
			state.timeRemaining--;
			updateTimerDisplay( roomId );

			if ( state.timeRemaining <= 0 ) {
				clearInterval( state.timerInterval );
				state.timerInterval = null;
				examMessage( roomId, 'Temps écoulé. Soumission automatique...', 'error' );
				examSubmit( roomId );
			}
		}, 1000 );
	}

	function updateTimerDisplay( roomId ) {
		var state = examState[ roomId ];
		if ( ! state ) {
			return;
		}
		$( '#seca-exam-time-' + roomId ).text( formatTime( state.timeRemaining ) );
		$( '#seca-exam-timer-' + roomId ).text( formatTime( state.timeRemaining ) );

			if ( state.timeRemaining <= 60 ) {
				$( '#seca-exam-time-' + roomId ).css( 'color', '#b91c1c' );
			}
	}

	function renderQuestions( roomId ) {
		var state = examState[ roomId ];
		if ( ! state || ! state.questions ) {
			return;
		}

		var $container = $( '#seca-exam-questions-' + roomId );
		$container.empty();

		state.questions.forEach( function ( q, index ) {
			var $q = $( '<div class="seca-exam-question" id="seca-exam-q-' + roomId + '-' + index + '"></div>' );
			var questionText = q.data.question || 'Question sans énoncé';

			$q.append( '<div class="seca-exam-question-text">' + ( index + 1 ) + '. ' + questionText.replace( /&/g, '&amp;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' ) + '</div>' );

			if ( q.data.mode === 'choice' && q.data.choices ) {
				q.data.choices.forEach( function ( choice, ci ) {
					var escaped = choice.replace( /&/g, '&amp;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' );
					var $choice = $( '<label class="seca-exam-choice"><input type="radio" name="seca-exam-answer-' + roomId + '-' + index + '" value="' + ci + '"> ' + escaped + '</label>' );
					$choice.find( 'input' ).on( 'change', function () {
						examAnswer( roomId, index, ci );
					});
					$q.append( $choice );
				});
			} else if ( q.data.mode === 'text' ) {
				var $input = $( '<input type="text" class="seca-exam-text-answer" placeholder="Votre réponse...">' );
				$input.on( 'input', function () {
					examAnswer( roomId, index, $input.val() );
				});
				$q.append( $input );
			} else if ( q.data.mode === 'flag' || q.data.mode === 'action' ) {
				var $input = $( '<input type="text" class="seca-exam-text-answer" placeholder="Entrez le flag...">' );
				$input.on( 'input', function () {
					examAnswer( roomId, index, $input.val() );
				});
				$q.append( $input );
			} else {
				$q.append( '<p style="color:#64748b;font-style:italic;">Type de question non supporté pour cet examen.</p>' );
			}

			$container.append( $q );
		});
	}

	function examAnswer( roomId, index, answer ) {
		var state = examState[ roomId ];
		if ( ! state ) {
			return;
		}

		var q = state.questions[ index ];
		if ( ! q ) {
			return;
		}

		$.post( secaExam.ajaxUrl, {
			action: 'secura_exam_answer',
			room_id: roomId,
			q_id: q.id,
			answer: answer,
			nonce: secaExam.nonce
		}, function ( resp ) {
			if ( ! resp.success ) {
				examMessage( roomId, resp.data && resp.data.message ? resp.data.message : 'Erreur lors de l\'enregistrement de la réponse.', 'error' );
			} else if ( resp.data && resp.data.time_remaining !== undefined ) {
				state.timeRemaining = resp.data.time_remaining;
				updateTimerDisplay( roomId );
			}
		}).fail( function () {
			// Ignorer les échecs de réseau pour les réponses individuelles
		});
	}

	function examSubmit( roomId ) {
		examMessage( roomId, secaExam.submitMsg + '...', 'info' );

		$.post( secaExam.ajaxUrl, {
			action: 'secura_exam_submit',
			room_id: roomId,
			nonce: secaExam.nonce
		}, function ( resp ) {
			if ( resp.success ) {
				var data = resp.data;
				var passed = data.passed;

				var $result = $( '#seca-exam-result-' + roomId );
				$result.removeClass().addClass( 'seca-exam-result ' + ( passed ? 'passed' : 'failed' ) );
				$result.text( passed ? 'Examen réussi ! ' : 'Examen non réussi. ' + 'Score : ' + data.score + ' / ' + data.total + ' (' + data.percentage + '%)' );
				$result.show();

				examMessage( roomId, passed ? 'Félicitations ! Vous avez réussi l\'examen.' : 'Vous pouvez retenter l\'examen.', passed ? 'success' : 'error' );

				$( '#seca-exam-start-' + roomId ).prop( 'disabled', true ).addClass( 'seca-hidden' );
				$( '#seca-exam-submit-' + roomId ).prop( 'disabled', true ).addClass( 'seca-hidden' );
				$( '#seca-exam-timer-display-' + roomId ).hide();
				$( '#seca-exam-questions-' + roomId ).hide();

				if ( state.timerInterval ) {
					clearInterval( state.timerInterval );
					state.timerInterval = null;
				}

				// Vérifier si un certificat est disponible
				checkCertificates();
			} else {
				examMessage( roomId, resp.data && resp.data.message ? resp.data.message : 'Erreur lors de la soumission.', 'error' );
			}
		}).fail( function () {
			examMessage( roomId, 'Erreur de connexion au serveur.', 'error' );
		});
	}

	function checkCertificates() {
		// Vérifier si des certificats sont disponibles (appelé après un examen réussi)
		// On recharge simplement la liste des certificats si elle est affichée
		if ( $( '.seca-certificates-container' ).length > 0 ) {
			location.reload();
		}
	}

	$( document ).on( 'click', '.seca-exam-button-start', function () {
		var roomId = $( this ).data( 'room-id' );
		examStart( roomId );
	});

	$( document ).on( 'click', '.seca-exam-button-submit', function () {
		var roomId = $( this ).data( 'room-id' );
		if ( confirm( 'Soumettre l\'examen maintenant ? Vous ne pourrez plus modifier vos réponses.' ) ) {
			examSubmit( roomId );
		}
	});
});
