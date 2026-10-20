<?php
/**
 * Spindles Child theme bootstrap.
 *
 * @package Spindles_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the child stylesheet after the parent's design layer.
 */
function spindles_child_styles() {
	wp_enqueue_style(
		'spindles-child',
		get_stylesheet_uri(),
		array( 'spindles-premium' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'spindles_child_styles', 20 );
