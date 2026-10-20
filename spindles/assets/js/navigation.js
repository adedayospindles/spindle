/**
 * Spindles mobile navigation toggle.
 *
 * Runs immediately (the script is enqueued in the footer), so it still works
 * when "delay JavaScript" optimisation plugins defer DOMContentLoaded.
 */
( function () {
	'use strict';

	function init() {
		var button = document.querySelector( '.menu-toggle' );
		var nav = document.getElementById( 'site-navigation' );

		if ( ! button || ! nav ) {
			return;
		}

		function setOpen( open ) {
			button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			nav.classList.toggle( 'is-open', open );
		}

		button.addEventListener( 'click', function () {
			setOpen( 'true' !== button.getAttribute( 'aria-expanded' ) );
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
				setOpen( false );
				button.focus();
			}
		} );

		// Close the menu when keyboard focus moves out of both the toggle and the menu.
		document.addEventListener( 'focusin', function ( event ) {
			if ( nav.classList.contains( 'is-open' ) && ! nav.contains( event.target ) && event.target !== button ) {
				setOpen( false );
			}
		} );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
