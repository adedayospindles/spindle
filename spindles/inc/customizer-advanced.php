<?php
/**
 * Advanced presentation options. Every option is optional and theme-scoped.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allowed values for each choice-type setting.
 *
 * @return array<string,string[]>
 */
function spindles_choice_values() {
	return array(
		'spindles_header_style'    => array( 'standard', 'centered', 'minimal' ),
		'spindles_header_position' => array( 'normal', 'sticky' ),
		'spindles_footer_style'    => array( 'columns', 'compact' ),
		'spindles_blog_layout'     => array( 'list', 'grid' ),
		'spindles_theme_mode'      => array( 'light', 'dark' ),
	);
}

/**
 * Sanitize a select setting against its allowed values.
 *
 * @param string               $value   Submitted value.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string
 */
function spindles_sanitize_choice( $value, $setting ) {
	$allowed = spindles_choice_values();
	$id      = $setting->id;

	return ( isset( $allowed[ $id ] ) && in_array( $value, $allowed[ $id ], true ) ) ? $value : $setting->default;
}

/**
 * Sanitize a checkbox setting.
 *
 * @param mixed $value Submitted value.
 * @return bool
 */
function spindles_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Register the Spindles Design System panel, sections, settings and controls.
 *
 * @param WP_Customize_Manager $customize Customizer manager.
 */
function spindles_advanced_customizer( $customize ) {
	$customize->add_panel(
		'spindles_design',
		array(
			'title'    => __( 'Spindles Design System', 'spindles' ),
			'priority' => 34,
		)
	);

	$sections = array(
		'spindles_brand'   => __( 'Brand & typography', 'spindles' ),
		'spindles_header'  => __( 'Header options', 'spindles' ),
		'spindles_footer'  => __( 'Footer options', 'spindles' ),
		'spindles_content' => __( 'Content options', 'spindles' ),
	);
	foreach ( $sections as $id => $name ) {
		$customize->add_section(
			$id,
			array(
				'title' => $name,
				'panel' => 'spindles_design',
			)
		);
	}

	// Each option: section, label, default, control type, optional choices.
	$options = array(
		'spindles_accent'           => array( 'spindles_brand', __( 'Accent color', 'spindles' ), '#2556a8', 'color' ),
		'spindles_ink'              => array( 'spindles_brand', __( 'Text color', 'spindles' ), '#162337', 'color' ),
		'spindles_theme_mode'       => array(
			'spindles_brand',
			__( 'Color mode', 'spindles' ),
			'light',
			'select',
			array(
				'light' => __( 'Light', 'spindles' ),
				'dark'  => __( 'Dark', 'spindles' ),
			),
		),
		'spindles_header_style'     => array(
			'spindles_header',
			__( 'Header layout', 'spindles' ),
			'standard',
			'select',
			array(
				'standard' => __( 'Standard', 'spindles' ),
				'centered' => __( 'Centered brand', 'spindles' ),
				'minimal'  => __( 'Minimal', 'spindles' ),
			),
		),
		'spindles_header_position'  => array(
			'spindles_header',
			__( 'Header position', 'spindles' ),
			'normal',
			'select',
			array(
				'normal' => __( 'Normal', 'spindles' ),
				'sticky' => __( 'Sticky', 'spindles' ),
			),
		),
		'spindles_show_tagline'     => array( 'spindles_header', __( 'Show site tagline', 'spindles' ), true, 'checkbox' ),
		'spindles_header_cta_label' => array( 'spindles_header', __( 'Header button label', 'spindles' ), '', 'text' ),
		'spindles_header_cta_url'   => array( 'spindles_header', __( 'Header button URL', 'spindles' ), '', 'url' ),
		'spindles_footer_style'     => array(
			'spindles_footer',
			__( 'Footer layout', 'spindles' ),
			'columns',
			'select',
			array(
				'columns' => __( 'Widget columns', 'spindles' ),
				'compact' => __( 'Compact', 'spindles' ),
			),
		),
		'spindles_footer_copy'      => array( 'spindles_footer', __( 'Footer copyright text (optional)', 'spindles' ), '', 'text' ),
		'spindles_back_to_top'      => array( 'spindles_footer', __( 'Show back-to-top link', 'spindles' ), true, 'checkbox' ),
		'spindles_blog_layout'      => array(
			'spindles_content',
			__( 'Blog layout', 'spindles' ),
			'list',
			'select',
			array(
				'list' => __( 'List', 'spindles' ),
				'grid' => __( 'Grid', 'spindles' ),
			),
		),
	);

	foreach ( $options as $id => $option ) {
		$type     = $option[3];
		$callback = 'sanitize_text_field';

		if ( 'color' === $type ) {
			$callback = 'sanitize_hex_color';
		} elseif ( 'select' === $type ) {
			$callback = 'spindles_sanitize_choice';
		} elseif ( 'checkbox' === $type ) {
			$callback = 'spindles_sanitize_checkbox';
		} elseif ( 'url' === $type ) {
			$callback = 'esc_url_raw';
		}

		$customize->add_setting(
			$id,
			array(
				'default'           => $option[2],
				'sanitize_callback' => $callback,
			)
		);

		if ( 'color' === $type ) {
			$customize->add_control(
				new WP_Customize_Color_Control(
					$customize,
					$id,
					array(
						'label'   => $option[1],
						'section' => $option[0],
					)
				)
			);
			continue;
		}

		$control = array(
			'label'   => $option[1],
			'section' => $option[0],
			'type'    => $type,
		);
		if ( 'select' === $type ) {
			$control['choices'] = $option[4];
		}
		$customize->add_control( $id, $control );
	}
}
add_action( 'customize_register', 'spindles_advanced_customizer' );

/**
 * Output the accent and text colors as CSS custom properties.
 */
function spindles_design_css() {
	$accent = sanitize_hex_color( get_theme_mod( 'spindles_accent', '#2556a8' ) );
	$ink    = sanitize_hex_color( get_theme_mod( 'spindles_ink', '#162337' ) );

	if ( ! $accent ) {
		$accent = '#2556a8';
	}
	if ( ! $ink ) {
		$ink = '#162337';
	}

	wp_add_inline_style( 'spindles-main', ':root{--sp-brand:' . $accent . ';--sp-ink:' . $ink . '}' );
}
add_action( 'wp_enqueue_scripts', 'spindles_design_css', 21 );

/**
 * Add design option body classes (header, position, footer, blog, mode).
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function spindles_design_classes( $classes ) {
	$allowed = array(
		'header'   => array( 'standard', 'centered', 'minimal' ),
		'position' => array( 'normal', 'sticky' ),
		'footer'   => array( 'columns', 'compact' ),
		'blog'     => array( 'list', 'grid' ),
		'mode'     => array( 'light', 'dark' ),
	);

	$options = array(
		'header'   => get_theme_mod( 'spindles_header_style', 'standard' ),
		'position' => get_theme_mod( 'spindles_header_position', 'normal' ),
		'footer'   => get_theme_mod( 'spindles_footer_style', 'columns' ),
		'blog'     => get_theme_mod( 'spindles_blog_layout', 'list' ),
		'mode'     => get_theme_mod( 'spindles_theme_mode', 'light' ),
	);

	foreach ( $options as $key => $value ) {
		$classes[] = 'sp-' . $key . '-' . ( in_array( $value, $allowed[ $key ], true ) ? $value : $allowed[ $key ][0] );
	}

	return $classes;
}
add_filter( 'body_class', 'spindles_design_classes' );
