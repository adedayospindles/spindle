<?php
/**
 * Main template (blog index fallback).
 *
 * @package Spindles
 */

get_header();
?>
<main id="primary" class="site-main container content-layout">
	<?php spindles_before_content(); ?>
	<div class="content-area">
		<header class="archive-header">
			<h1><?php echo is_home() ? esc_html__( 'Latest posts', 'spindles' ) : esc_html( get_bloginfo( 'name' ) ); ?></h1>
		</header>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				spindles_post_card();
			endwhile;
			the_posts_pagination();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div>
	<?php
	get_sidebar();
	spindles_after_content();
	?>
</main>
<?php
get_footer();
