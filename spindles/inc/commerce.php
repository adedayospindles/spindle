<?php
/**
 * Optional WooCommerce enhancements. The theme has no shop dependency.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Open the main landmark for WooCommerce content.
 */
function spindles_woocommerce_wrapper_start() {
	echo '<main id="primary" class="site-main container woocommerce-content">';
}

/**
 * Close the main landmark for WooCommerce content.
 */
function spindles_woocommerce_wrapper_end() {
	echo '</main>';
}

/**
 * Number of products per shop page.
 *
 * @return int
 */
function spindles_products_per_page() {
	return (int) apply_filters( 'spindles_shop_products_per_page', 12 );
}

/**
 * Swap WooCommerce's default wrappers for the theme's, only when WooCommerce is active.
 */
function spindles_woocommerce_integrate() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_before_main_content', 'spindles_woocommerce_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'spindles_woocommerce_wrapper_end', 10 );
	add_filter( 'loop_shop_per_page', 'spindles_products_per_page', 20 );
}
add_action( 'wp', 'spindles_woocommerce_integrate' );
