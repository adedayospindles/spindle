<?php
/**
 * Optional integrations. No plugin is loaded or required here.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Elementor Pro Theme Builder locations (header, footer, single, archive).
 *
 * @param object $manager Elementor locations manager.
 */
function spindles_elementor_locations( $manager ) {
	if ( method_exists( $manager, 'register_all_core_location' ) ) {
		$manager->register_all_core_location();
	}
}
add_action( 'elementor/theme/register_locations', 'spindles_elementor_locations' );

/**
 * Render an Elementor Theme Builder location inside the #primary <main> landmark.
 *
 * Keeps the skip link target and the main landmark present even when Elementor
 * replaces the theme markup for a request.
 *
 * @param string $location Elementor location name (single, archive).
 * @return bool True when Elementor rendered the location.
 */
function spindles_do_elementor_location( $location ) {
	if ( ! function_exists( 'elementor_theme_do_location' ) ) {
		return false;
	}

	ob_start();
	$handled = elementor_theme_do_location( $location );
	$output  = ob_get_clean();

	if ( ! $handled ) {
		return false;
	}

	// Markup is generated and escaped by Elementor.
	echo '<main id="primary" class="site-main sp-elementor-main">' . $output . '</main>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return true;
}

/**
 * Declare WooCommerce support. Only takes effect when WooCommerce is active.
 */
function spindles_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 360,
			'single_image_width'    => 720,
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'spindles_woocommerce_support' );

// ACF Pro and Modern Events Calendar use normal WordPress content and templates.
// Child themes or projects can hook these actions to create custom integrations.

/**
 * Fire the action before page content.
 */
function spindles_before_content() {
	do_action( 'spindles_before_content' );
}

/**
 * Fire the action after page content.
 */
function spindles_after_content() {
	do_action( 'spindles_after_content' );
}

/**
 * Add the builder-neutral body class for the matching page template.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function spindles_builder_body_class( $classes ) {
	if ( is_page_template( 'templates/builder.php' ) ) {
		$classes[] = 'sp-builder-neutral';
	}
	return $classes;
}
add_filter( 'body_class', 'spindles_builder_body_class' );

/**
 * Fire the action before event output (hook for Modern Events Calendar styling).
 */
function spindles_before_events() {
	do_action( 'spindles_before_events' );
}

/**
 * Fire the action after event output.
 */
function spindles_after_events() {
	do_action( 'spindles_after_events' );
}
