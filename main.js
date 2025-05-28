'use strict';

	// NOTE: Please do not use any third-party libraries to implement the
	// following as we want to keep the JS payload as small as possible. You may
	// use ES6. There is no need to support IE11.
	//
	// TODO A: Improve the readability of this file through refactoring and
	// documentation. Make any changes you think are necessary.
	//
	// TODO B: When typing in the "title" field, we want to auto-complete based on
	// article titles that already exist. You may use the
	// api.php?prefixsearch={search} endpoint for auto-completion. To avoid
	// hitting the server endpoint excessively, please also add JavaScript code
	// that ensures at least 200ms has passed between requests. Check the
	// `design-spec/auto-complete-hover.png` file for the design spec.
	// Also, you don't need to make the autocomplete list disappear when the input
	// has lost focus in this TODO. That will be handled as part of TODO D.
	//
	// TODO C: When the user selects an item from the auto-complete list, we want
	// the textarea to populate with that article's contents. You may use the
	// api.php?title={title} endpoint to get the article's contents. Check the
	// `design-spec/auto-complete-select.png` file for the design spec.
	//
	// TODO D: The autocomplete list should only be shown when the input receives
	// focus. The list should be hidden after the user selects an item from the
	// list or after the input loses focus.
	//
	// TODO E: Figure out how to make multiple requests to the server as the user
	// scrolls through the autocomplete list.
	//
	// TODO F: Add error-handling requirements, such as displaying error messages
	// to the user when API requests fail and provide a graceful degradation of
	// functionality.

document.addEventListener( 'DOMContentLoaded', () => {
	initFormSubmit();
	initAutocomplete();
});

/**
 * Initialise form to add an event listener to submit the form when the submit button is clicked.
 */
function initFormSubmit() {
	const submitButton = document.querySelector( '.submit-button' );
	const form = document.querySelector( 'form' );

	if (submitButton && form) {
		submitButton.addEventListener( 'click', (e) => {
			e.preventDefault();
			form.submit();
		} );
	}
}

/**
 * Initialize autocomplete functionality.
 */
function initAutocomplete() {
	const input = document.querySelector( 'input[name="title"]' );
	const suggestionsBox = document.createElement( 'ul' );
	suggestionsBox.classList.add( 'suggestions-box' );
	input.parentNode.insertBefore( suggestionsBox, input.nextSibling );

	let debounceTimer;

	input.addEventListener( 'input', (e) => {
		clearTimeout(debounceTimer);
		debounceTimer = setTimeout(() => {
			const search = input.value.trim();
			if (search.length > 0) {

				fetchSuggestions(search)
					.then(titles => renderSuggestions(titles, suggestionsBox, input))
					.catch(err => console.error(err));
			}
		}, 200);
	})
}

/**
 * Fetch suggestions from the server.
 * @param prefix
 * @returns {Promise<any>}
 */
function fetchSuggestions(prefix) {
	return fetch(`api.php?prefixsearch=${encodeURIComponent(prefix)}`)
		.then(
			response => response.json(),
			(err) => {
				throw new Error('Failed to fetch suggestions.')
			}
		)
		.then(data => data.content || []);
}

/**
 * Render suggestions to the DOM.
 * @param titles
 * @param container
 * @param input
 */
function renderSuggestions(titles, container, input) {
	container.innerHTML = ''; // Clear previous results
	titles.forEach(title => {
		const li = document.createElement('li');
		li.textContent = title;
		li.addEventListener('click', () => {
			input.value = title;
			container.innerHTML = '';
			fetchArticleContent(title);
		});
		container.appendChild(li);
	})
}

/**
 * Fetch article content from the server.
 * @param title
 */
function fetchArticleContent(title) {
	const textarea = document.querySelector( 'textarea[name="body"]' );
	fetch(`api.php?title=${encodeURIComponent(title)}`)
		.then(
			response => response.text(),
			(err) => {
				throw new Error('Failed to fetch article content.')
			}
		)
		.then(data => {
			textarea.value = data.content || ''
		})
		.catch(err => console.error(err));
}
