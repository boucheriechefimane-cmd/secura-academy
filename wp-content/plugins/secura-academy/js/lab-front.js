/**
 * Front JS pour le bouton de démarrage de lab Secura Academy.
 * Appelle l'API AJAX : secura_lab_start, secura_lab_stop, secura_lab_status.
 */

jQuery( function ( $ ) {
	'use strict';

	function labOutput( roomId, message, type ) {
		var $out = $( '#seca-lab-output-' + roomId );
		if ( $out.length === 0 ) {
			return;
		}
		var time = new Date().toLocaleTimeString();
		var cls  = type === 'error' ? 'seca-lab-error' : type === 'success' ? 'seca-lab-success' : '';
		$out.append( '<div class="' + cls + '">[' + time + '] ' + message.replace( /&/g, '&amp;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' ) + '</div>' );
		$out.scrollTop( $out[0].scrollHeight );
	}

	function labSetButtons( roomId, running ) {
		var $start = $( '#seca-lab-start-' + roomId );
		var $stop  = $( '#seca-lab-stop-' + roomId );
		if ( running ) {
			$start.prop( 'disabled', true ).addClass( 'seca-hidden' );
			$stop.prop( 'disabled', false ).removeClass( 'seca-hidden' );
		} else {
			$start.prop( 'disabled', false ).removeClass( 'seca-hidden' );
			$stop.prop( 'disabled', true ).addClass( 'seca-hidden' );
		}
	}

	function labStart( roomId ) {
		labOutput( roomId, secaLab.startMsg + '...', 'info' );
		$.post( secaLab.ajaxUrl, {
			action: 'secura_lab_start',
			room_id: roomId,
			nonce: secaLab.nonce
		}, function ( resp ) {
			if ( resp.success ) {
				labOutput( roomId, resp.data.message || 'Lab démarré.', 'success' );
				labSetButtons( roomId, true );
				if ( resp.data.target ) {
					$( '#seca-lab-target-' + roomId ).html( '<strong>Cible :</strong> ' + resp.data.target );
				}
			} else {
				labOutput( roomId, resp.data && resp.data.message ? resp.data.message : 'Erreur inconnue.', 'error' );
			}
		}).fail( function () {
			labOutput( roomId, 'Erreur de connexion au serveur.', 'error' );
		});
	}

	function labStop( roomId ) {
		labOutput( roomId, secaLab.stopMsg + '...', 'info' );
		$.post( secaLab.ajaxUrl, {
			action: 'secura_lab_stop',
			room_id: roomId,
			nonce: secaLab.nonce
		}, function ( resp ) {
			if ( resp.success ) {
				labOutput( roomId, 'Lab arrêté.', 'success' );
				labSetButtons( roomId, false );
				$( '#seca-lab-target-' + roomId ).empty();
			} else {
				labOutput( roomId, resp.data && resp.data.message ? resp.data.message : 'Erreur inconnue.', 'error' );
			}
		}).fail( function () {
			labOutput( roomId, 'Erreur de connexion au serveur.', 'error' );
		});
	}

	function labStatus( roomId ) {
		$.post( secaLab.ajaxUrl, {
			action: 'secura_lab_status',
			room_id: roomId,
			nonce: secaLab.nonce
		}, function ( resp ) {
			if ( resp.success ) {
				var lab = resp.data.lab || {};
				labSetButtons( roomId, lab.state === 'running' );
				labOutput( roomId, 'Statut : ' + ( lab.state || 'inconnu' ), 'info' );
			}
		});
	}

	$( document ).on( 'click', '.seca-lab-button-start', function () {
		var roomId = $( this ).data( 'room-id' );
		labStart( roomId );
	});

	$( document ).on( 'click', '.seca-lab-button-stop', function () {
		var roomId = $( this ).data( 'room-id' );
		labStop( roomId );
	});

	$( document ).on( 'click', '.seca-lab-button-status', function () {
		var roomId = $( this ).data( 'room-id' );
		labStatus( roomId );
	});

	// Vérifier le statut au chargement de la page
	$( '.seca-lab-container' ).each( function () {
		var roomId = $( this ).data( 'room-id' );
		if ( roomId ) {
			labStatus( roomId );
		}
	});
});
