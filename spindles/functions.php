<?php
/**
 * Spindles theme bootstrap.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SPINDLES_VERSION', '2.1.1' );

require_once get_template_directory() . '/inc/theme.php';
require_once get_template_directory() . '/inc/integrations.php';
require_once get_template_directory() . '/inc/customizer-advanced.php';
require_once get_template_directory() . '/inc/dynamic-content.php';
require_once get_template_directory() . '/inc/commerce.php';
