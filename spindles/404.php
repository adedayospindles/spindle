<?php
/**
 * 404 template.
 *
 * @package Spindles
 */

get_header();

if ( ! spindles_do_elementor_location( 'single' ) ) :
	?>
<main id="primary" class="site-main container error-page">
	<h1><?php esc_html_e( 'Page not found', 'spindles' ); ?></h1>
	<p><?php esc_html_e( 'We could not find that page. Try searching instead.', 'spindles' ); ?></p>
	<?php get_search_form( array( 'aria_label' => __( 'Search from error page', 'spindles' ) ) ); ?>
</main>
	<?php
endif;

get_footer();
