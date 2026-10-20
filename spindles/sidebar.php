<?php
/**
 * Sidebar.
 *
 * @package Spindles
 */

if ( is_active_sidebar( 'sidebar-1' ) ) :
	?>
<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Sidebar', 'spindles' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
	<?php
endif;
