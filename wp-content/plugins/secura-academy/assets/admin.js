/**
 * Secura Academy — éditeur de rooms et de parcours dans l'admin.
 *
 * Les champs utilisent la syntaxe `nom[]` de PHP : l'ordre du DOM suffit
 * à reconstruire la structure, aucun réindexation manuelle n'est requise.
 */
( function () {
	'use strict';

	/**
	 * Clone un modèle HTML et l'insère dans un conteneur.
	 *
	 * @param {string} templateId Identifiant du modèle.
	 * @param {Element} container Conteneur cible.
	 * @return {Element|null} Élément inséré.
	 */
	function cloneTemplate( templateId, container ) {
		var template = document.getElementById( templateId );

		if ( ! template || ! container ) {
			return null;
		}

		var holder = document.createElement( 'div' );

		holder.innerHTML = template.innerHTML;

		var node = holder.firstElementChild;

		if ( ! node ) {
			return null;
		}

		container.appendChild( node );

		return node;
	}

	/* ------------------------------------------------------ Rooms : tâches */

	var tasksContainer = document.getElementById( 'secura-tasks' );
	var addTaskButton = document.getElementById( 'secura-add-task' );

	/**
	 * Renumérote les questions d'une tâche.
	 *
	 * @param {Element} taskRow Ligne de tâche.
	 */
	function renumberQuestions( taskRow ) {
		var rows = taskRow.querySelectorAll( '.secura-question-row' );

		Array.prototype.forEach.call( rows, function ( row, index ) {
			var label = row.querySelector( '.secura-question-number' );

			if ( label ) {
				label.textContent = String( index + 1 );
			}
		} );
	}

	/**
	 * Renumérote toutes les tâches.
	 */
	function renumberTasks() {
		if ( ! tasksContainer ) {
			return;
		}

		var rows = tasksContainer.querySelectorAll( '.secura-task-row' );

		Array.prototype.forEach.call( rows, function ( row, index ) {
			var label = row.querySelector( '.secura-task-number' );

			if ( label ) {
				label.textContent = String( index + 1 );
			}

			renumberQuestions( row );
		} );
	}

	if ( addTaskButton && tasksContainer ) {
		addTaskButton.addEventListener( 'click', function () {
			var node = cloneTemplate( 'secura-task-template', tasksContainer );

			if ( node ) {
				renumberTasks();

				var type = node.querySelector( 'select[name*="[type]"]' );

				if ( type ) {
					type.focus();
				}
			}
		} );
	}

	if ( tasksContainer ) {
		tasksContainer.addEventListener( 'click', function ( event ) {
			var button = event.target.closest ? event.target.closest( '.seca-remove-task, .seca-remove-question, .seca-add-question' ) : null;

			if ( ! button ) {
				return;
			}

			event.preventDefault();

			if ( button.classList.contains( 'seca-add-question' ) ) {
				var taskRow = button.closest( '.secura-task-row' );
				var questions = taskRow ? taskRow.querySelector( '.secura-questions' ) : null;

				if ( questions ) {
					cloneTemplate( 'secura-question-template', questions );
					renumberQuestions( taskRow );
				}

				return;
			}

			if ( button.classList.contains( 'seca-remove-question' ) ) {
				var questionRow = button.closest( '.secura-question-row' );
				var parentTask = button.closest( '.secura-task-row' );

				if ( questionRow && questionRow.parentNode ) {
					questionRow.parentNode.removeChild( questionRow );
				}

				if ( parentTask ) {
					renumberQuestions( parentTask );
				}

				return;
			}

			var taskRow = button.closest( '.secura-task-row' );

			if ( taskRow && taskRow.parentNode ) {
				taskRow.parentNode.removeChild( taskRow );
			}

			renumberTasks();
		} );

		renumberTasks();
	}

	/* ---------------------------------------------------- Parcours : sections */

	var sectionsContainer = document.getElementById( 'secura-sections' );
	var addSectionButton = document.getElementById( 'secura-add-section' );

	if ( addSectionButton && sectionsContainer ) {
		addSectionButton.addEventListener( 'click', function () {
			var node = cloneTemplate( 'secura-section-template', sectionsContainer );

			if ( node ) {
				var input = node.querySelector( 'input[type="text"]' );

				if ( input ) {
					input.focus();
				}
			}
		} );
	}
} )();
