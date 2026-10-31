/**
 * Secura Academy — gestion des questions dans l'admin.
 */
( function () {
	'use strict';

	var container = document.getElementById( 'secura-questions' );
	var addButton = document.getElementById( 'secura-add-question' );
	var template = document.getElementById( 'secura-question-template' );

	if ( ! container || ! addButton || ! template ) {
		return;
	}

	/**
	 * Réindexe les champs pour garder un ordre continu.
	 */
	function reindex() {
		var rows = container.querySelectorAll( '.secura-question-row' );

		Array.prototype.forEach.call( rows, function ( row, index ) {
			row.setAttribute( 'data-index', String( index ) );

			var number = row.querySelector( '.secura-question-number' );

			if ( number ) {
				number.textContent = String( index + 1 );
			}

			var fields = row.querySelectorAll( '[name]' );

			Array.prototype.forEach.call( fields, function ( field ) {
				field.name = field.name.replace( /secura_questions\[\d+\]/, 'secura_questions[' + index + ']' );
			} );
		} );
	}

	/**
	 * Ajoute une ligne de question vide.
	 */
	function addRow() {
		var row = template.innerHTML.replace( /%INDEX%/g, String( container.querySelectorAll( '.secura-question-row' ).length ) );

		var wrapper = document.createElement( 'div' );
		wrapper.innerHTML = row;

		var node = wrapper.firstElementChild;

		if ( node ) {
			container.appendChild( node );
			reindex();
		}
	}

	addButton.addEventListener( 'click', addRow );

	container.addEventListener( 'click', function ( event ) {
		var button = event.target.closest ? event.target.closest( '.seca-remove-question' ) : null;

		if ( ! button ) {
			return;
		}

		event.preventDefault();

		var row = button.closest( '.secura-question-row' );

		if ( row ) {
			row.parentNode.removeChild( row );
			reindex();
		}
	} );
} )();
