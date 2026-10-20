<?php
/**
 * Single post template.
 *
 * @package Spindles
 */

get_header();

if ( ! spindles_do_elementor_location( 'single' ) ) :
	?>
<main id="primary" class="site-main container content-layout">
	<div class="content-area">
		<?php
		spindles_before_content();
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php spindles_post_meta(); ?>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="featured-image"><?php the_post_thumbnail( 'full' ); ?></div>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
				<footer class="entry-footer">
					<?php the_tags( '<div class="tags">', ', ', '</div>' ); ?>
				</footer>
			</article>
			<?php
			the_post_navigation();
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		spindles_after_content();
		?>
	</div>
	<?php get_sidebar(); ?>
</main>
	<?php
endif;

get_footer();
