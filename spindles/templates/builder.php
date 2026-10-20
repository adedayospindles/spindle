<?php
/**
 * Template Name: Builder Neutral
 * Template Post Type: page
 *
 * Retains theme header/footer while giving editors an unconstrained main canvas.
 *
 * @package Spindles
 */

get_header();
?>
<main id="primary" class="builder-neutral-content">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			the_content();
			wp_link_pages();
			?>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
