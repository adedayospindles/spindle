<?php
/**
 * Default page template.
 *
 * @package Spindles
 */

get_header();

if ( ! spindles_do_elementor_location( 'single' ) ) :
	?>
<main id="primary" class="site-main container singular-content">
	<?php
	spindles_before_content();
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
		</article>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	spindles_after_content();
	?>
</main>
	<?php
endif;

get_footer();
