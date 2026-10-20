<?php
/**
 * Search form.
 *
 * @package Spindles
 */

$spindles_search_id    = wp_unique_id( 'search-' );
$spindles_search_label = ! empty( $args['aria_label'] ) ? $args['aria_label'] : __( 'Site search', 'spindles' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( $spindles_search_label ); ?>">
	<label for="<?php echo esc_attr( $spindles_search_id ); ?>"><?php esc_html_e( 'Search', 'spindles' ); ?></label>
	<div class="search-row">
		<input type="search" id="<?php echo esc_attr( $spindles_search_id ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" required>
		<button type="submit"><?php esc_html_e( 'Search', 'spindles' ); ?></button>
	</div>
</form>
