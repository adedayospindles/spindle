<?php
/**
 * Search results template.
 *
 * @package Spindles
 */

get_header();

if ( ! spindles_do_elementor_location( 'archive' ) ) :
	?>
<main id="primary" class="site-main container content-layout">
	<div class="content-area">
		<h1>
			<?php
			/* translators: %s: Search query. */
			printf( esc_html__( 'Search results for: %s', 'spindles' ), esc_html( get_search_query() ) );
			?>
		</h1>
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
	<?php get_sidebar(); ?>
</main>
	<?php
endif;

get_footer();
