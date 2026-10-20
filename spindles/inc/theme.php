<?php
/**
 * Core theme support.
 *
 * @package Spindles
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports, menus and the editor stylesheet.
 */
function spindles_setup() {
	load_theme_textdomain( 'spindles', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'spindles' ),
			'footer'  => __( 'Footer Navigation', 'spindles' ),
		)
	);
}
add_action( 'after_setup_theme', 'spindles_setup' );

/**
 * Set the maximum embedded content width (used by oEmbed and media).
 */
function spindles_content_width() {
	// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Core-documented global for themes.
	$GLOBALS['content_width'] = (int) apply_filters( 'spindles_content_width', 760 );
}
add_action( 'after_setup_theme', 'spindles_content_width', 0 );

/**
 * Flag that JavaScript is available so the mobile menu can collapse safely.
 */
function spindles_js_flag() {
	wp_print_inline_script_tag( "document.documentElement.classList.add('has-js');" );
}
add_action( 'wp_head', 'spindles_js_flag', 1 );

/**
 * Enqueue front-end styles and scripts.
 */
function spindles_assets() {
	wp_enqueue_style( 'spindles-style', get_template_directory_uri() . '/style.css', array(), SPINDLES_VERSION );
	wp_enqueue_style( 'spindles-main', get_template_directory_uri() . '/assets/css/main.css', array( 'spindles-style' ), SPINDLES_VERSION );
	wp_enqueue_script( 'spindles-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), SPINDLES_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spindles_assets' );

/**
 * Enqueue the design layer after the foundation styles.
 */
function spindles_premium_assets() {
	wp_enqueue_style( 'spindles-premium', get_template_directory_uri() . '/assets/css/premium.css', array( 'spindles-main' ), SPINDLES_VERSION );
}
add_action( 'wp_enqueue_scripts', 'spindles_premium_assets', 12 );

/**
 * Register the sidebar and three footer widget areas.
 */
function spindles_widgets() {
	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name' => __( 'Sidebar', 'spindles' ),
				'id'   => 'sidebar-1',
			)
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array_merge(
				$defaults,
				array(
					/* translators: %d: Footer widget area number. */
					'name' => sprintf( __( 'Footer %d', 'spindles' ), $i ),
					'id'   => 'footer-' . $i,
				)
			)
		);
	}
}
add_action( 'widgets_init', 'spindles_widgets' );

/**
 * Excerpt ellipsis.
 *
 * @return string
 */
function spindles_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'spindles_excerpt_more' );

/**
 * Register the layout width control.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function spindles_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'spindles_layout',
		array(
			'title'    => __( 'Spindles Layout', 'spindles' ),
			'priority' => 35,
		)
	);
	$wp_customize->add_setting(
		'spindles_container_width',
		array(
			'default'           => 1200,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'spindles_container_width',
		array(
			'label'       => __( 'Content width (pixels)', 'spindles' ),
			'section'     => 'spindles_layout',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 760,
				'max'  => 1600,
				'step' => 20,
			),
		)
	);
}
add_action( 'customize_register', 'spindles_customizer' );

/**
 * Output the container width as a CSS custom property.
 */
function spindles_dynamic_css() {
	$width = max( 760, min( 1600, absint( get_theme_mod( 'spindles_container_width', 1200 ) ) ) );
	wp_add_inline_style( 'spindles-main', ':root{--sp-container:' . $width . 'px}' );
}
add_action( 'wp_enqueue_scripts', 'spindles_dynamic_css', 20 );

/**
 * Add template body classes.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function spindles_body_classes( $classes ) {
	if ( is_page_template( 'templates/full-width.php' ) || is_page_template( 'templates/canvas.php' ) ) {
		$classes[] = 'sp-full-width';
	}
	if ( is_page_template( 'templates/canvas.php' ) ) {
		$classes[] = 'sp-canvas';
	}
	return $classes;
}
add_filter( 'body_class', 'spindles_body_classes' );

/**
 * Print post date and author.
 */
function spindles_post_meta() {
	echo '<div class="entry-meta"><span>' . esc_html( get_the_date() ) . '</span><span>' . esc_html( get_the_author() ) . '</span></div>';
}

/**
 * Print a post card for index and archive loops.
 */
function spindles_post_card() {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<a class="post-card-image" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		<?php endif; ?>
		<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
		<?php spindles_post_meta(); ?>
		<div class="entry-summary"><?php the_excerpt(); ?></div>
		<a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'spindles' ); ?><span class="screen-reader-text"> <?php echo esc_html( get_the_title() ); ?></span></a>
	</article>
	<?php
}
