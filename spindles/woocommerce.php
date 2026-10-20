<?php
/**
 * WooCommerce wrapper template.
 *
 * Uses Elementor Theme Builder locations when a matching template exists,
 * otherwise renders standard WooCommerce content inside the theme layout.
 *
 * @package Spindles
 */

get_header();

$spindles_handled = false;
if ( function_exists( 'is_product' ) && is_product() ) {
	$spindles_handled = spindles_do_elementor_location( 'single' );
} else {
	$spindles_handled = spindles_do_elementor_location( 'archive' );
}

if ( ! $spindles_handled ) {
	do_action( 'woocommerce_before_main_content' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound,WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce core hook.
	if ( function_exists( 'woocommerce_content' ) ) {
		woocommerce_content();
	}
	do_action( 'woocommerce_after_main_content' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound,WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce core hook.
}

get_footer();
