<?php
/**
 * Template part: no results.
 *
 * @package Spindles
 */

?>
<section class="no-results">
	<h2><?php esc_html_e( 'Nothing found', 'spindles' ); ?></h2>
	<p><?php esc_html_e( 'Try another search or browse the site.', 'spindles' ); ?></p>
	<?php get_search_form( array( 'aria_label' => __( 'Search again', 'spindles' ) ) ); ?>
</section>
