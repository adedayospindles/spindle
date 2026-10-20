<?php
/**
 * Comments template. Supports threaded comments, pingbacks and a closed notice.
 *
 * @package Spindles
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$spindles_comment_count = get_comments_number();
			printf(
				/* translators: 1: Number of comments, 2: Post title. */
				esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $spindles_comment_count, 'comments title', 'spindles' ) ),
				esc_html( number_format_i18n( $spindles_comment_count ) ),
				esc_html( get_the_title() )
			);
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'spindles' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</section>
