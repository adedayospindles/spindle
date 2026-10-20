<?php
/**
 * Archive template.
 *
 * @package Spindles
 */

get_header();

if ( ! spindles_do_elementor_location( 'archive' ) ) :
	?>
<main id="primary" class="site-main container content-layout">
	<div class="content-area">
		<header class="archive-header">
			<?php
			the_archive_title( '<h1>', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
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
	<?php get_sidebar(); ?>
</main>
	<?php
endif;

get_footer();
