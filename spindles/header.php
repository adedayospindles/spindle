<?php
/**
 * Theme header.
 *
 * @package Spindles
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'spindles' ); ?></a>
<?php do_action( 'spindles_before_header' ); ?>
<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
<header id="masthead" class="site-header">
	<div class="container header-inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'spindles_show_tagline', true ) && get_bloginfo( 'description' ) ) : ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
		</div>
		<button class="menu-toggle" aria-expanded="false" aria-controls="site-navigation"><span aria-hidden="true">&#9776;</span> <span><?php esc_html_e( 'Menu', 'spindles' ); ?></span></button>
		<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'spindles' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>
		<?php
		$spindles_cta_label = get_theme_mod( 'spindles_header_cta_label', '' );
		$spindles_cta_url   = get_theme_mod( 'spindles_header_cta_url', '' );
		if ( $spindles_cta_label && $spindles_cta_url ) :
			?>
			<a class="sp-header-cta" href="<?php echo esc_url( $spindles_cta_url ); ?>"><?php echo esc_html( $spindles_cta_label ); ?></a>
		<?php endif; ?>
	</div>
</header>
<?php endif; ?>
<?php do_action( 'spindles_after_header' ); ?>
