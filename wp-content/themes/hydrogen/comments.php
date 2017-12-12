<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if( post_password_required() ) {
	return;
}
?><div id="comments" class="post-comments">
	<?php if( have_comments() ): ?>
		<div class="comment-wrap">
			<h4 class="comment-count alt-style text-uppercase">
				<?php comments_number( __( '0 comments', 'youxi' ), __( '1 comment', 'youxi' ), __( '% comments', 'youxi' ) ) ?>
			</h4>
			<ul class="comment-list">
				<?php wp_list_comments( array( 'callback' => 'hydrogen_comment' )); ?>
			</ul>
			<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
			<nav class="comment-navigation">
				<ul class="pager">
					<li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'youxi' ) ); ?></li>
					<li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'youxi' ) ); ?></li>
				</ul>
			</nav>
			<?php endif; ?>
		</div>
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<div class="alert alert-warning"><?php _e( 'Comments are closed.', 'youxi' ); ?></div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="comment-form-wrap">
		<?php comment_form(); ?>
	</div>
</div>