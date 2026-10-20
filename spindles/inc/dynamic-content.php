<?php
/**
 * ACF presentation helpers with a WordPress-core post meta fallback. ACF is not required.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a field value from ACF when available, otherwise from post meta.
 *
 * Keys starting with an underscore (protected meta) are never returned.
 *
 * @param string $key      Field name.
 * @param int    $post_id  Post ID. Defaults to the current post.
 * @param mixed  $fallback Value returned when the field is empty.
 * @return mixed
 */
function spindles_get_dynamic_field( $key, $post_id = 0, $fallback = '' ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	$key     = sanitize_key( $key );

	if ( ! $post_id || ! $key || '_' === substr( $key, 0, 1 ) ) {
		return $fallback;
	}

	$value = function_exists( 'get_field' ) ? get_field( $key, $post_id ) : get_post_meta( $post_id, $key, true );

	return ( null === $value || false === $value || '' === $value ) ? $fallback : $value;
}

/**
 * Echo a scalar field value, escaped.
 *
 * @param string $key      Field name.
 * @param int    $post_id  Post ID. Defaults to the current post.
 * @param mixed  $fallback Value shown when the field is empty.
 */
function spindles_the_dynamic_field( $key, $post_id = 0, $fallback = '' ) {
	$value = spindles_get_dynamic_field( $key, $post_id, $fallback );
	if ( is_scalar( $value ) ) {
		echo esc_html( (string) $value );
	}
}

/**
 * Build wrapped markup for a scalar field. Call from bespoke page templates.
 *
 * @param string $key  Field name.
 * @param array  $args Optional. post_id, tag (div|span|p|h2|h3|strong), class, default.
 * @return string Escaped HTML, or an empty string when the field is empty.
 */
function spindles_dynamic_field_markup( $key, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'post_id' => 0,
			'tag'     => 'div',
			'class'   => 'sp-dynamic-field',
			'default' => '',
		)
	);

	$tags  = array( 'div', 'span', 'p', 'h2', 'h3', 'strong' );
	$tag   = in_array( $args['tag'], $tags, true ) ? $args['tag'] : 'div';
	$value = spindles_get_dynamic_field( $key, $args['post_id'], $args['default'] );

	if ( ! is_scalar( $value ) || '' === (string) $value ) {
		return '';
	}

	return '<' . $tag . ' class="' . esc_attr( sanitize_html_class( $args['class'] ) ) . '">' . esc_html( (string) $value ) . '</' . $tag . '>';
}

/**
 * Print label/value rows for ACF or post meta fields. Call inside a <dl>.
 *
 * @param array $fields  Map of field key => label.
 * @param int   $post_id Post ID. Defaults to the current post.
 */
function spindles_render_dynamic_details( $fields, $post_id = 0 ) {
	if ( ! is_array( $fields ) ) {
		return;
	}

	foreach ( $fields as $key => $label ) {
		$value = spindles_get_dynamic_field( $key, $post_id );
		if ( ! is_scalar( $value ) || '' === (string) $value ) {
			continue;
		}
		echo '<div class="sp-detail-row"><dt>' . esc_html( $label ) . '</dt><dd>' . esc_html( (string) $value ) . '</dd></div>';
	}
}
