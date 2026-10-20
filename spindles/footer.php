<?php
/**
 * Theme footer.
 *
 * @package Spindles
 */

do_action( 'spindles_before_footer' );

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
	$spindles_footer_areas = array_filter( array( 'footer-1', 'footer-2', 'footer-3' ), 'is_active_sidebar' );
	$spindles_footer_copy  = get_theme_mod( 'spindles_footer_copy', '' );
	?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if ( 'compact' !== get_theme_mod( 'spindles_footer_style', 'columns' ) && $spindles_footer_areas ) : ?>
			<div class="footer-widgets">
				<?php foreach ( $spindles_footer_areas as $spindles_area ) : ?>
					<div class="footer-widget-column"><?php dynamic_sidebar( $spindles_area ); ?></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="footer-bottom">
			<span>
				<?php
				if ( $spindles_footer_copy ) {
					echo esc_html( $spindles_footer_copy );
				} else {
					echo '&copy; ' . esc_html( wp_date( 'Y' ) ) . ' ' . esc_html( get_bloginfo( 'name' ) );
				}
				?>
			</span>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location'       => 'footer',
						'container'            => 'nav',
						'container_aria_label' => __( 'Footer navigation', 'spindles' ),
						'depth'                => 1,
					)
				);
			}
			?>
		</div>
	</div>
</footer>
<?php endif; ?>
<?php if ( get_theme_mod( 'spindles_back_to_top', true ) ) : ?>
<nav class="sp-back-to-top-wrap" aria-label="<?php esc_attr_e( 'Back to top', 'spindles' ); ?>">
	<a class="sp-back-to-top" href="#top"><span aria-hidden="true">&uarr;</span><span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'spindles' ); ?></span></a>
</nav>
<?php endif; ?>
<?php do_action( 'spindles_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
