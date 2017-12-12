<article id="<?php echo esc_attr( $post->post_name ) ?>" <?php post_class() ?>>

	<?php get_template_part( 'template-parts/' . get_post_type() . '/media', get_post_format() );

	if( ! is_single() ): ?>

	<header class="post-header">
		<?php
			the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			if( $post_meta = hydrogen_post_meta() ):
		?><p class="post-meta">
			<?php echo $post_meta ?>
		</p>
		<?php endif; ?>
	</header>

	<div class="post-summary">
		<?php the_excerpt(); ?>
		<a href="<?php echo esc_url( get_permalink() ) ?>" class="btn btn-primary btn-sm">
			<?php _e( 'Continue Reading', 'youxi' ) ?>
		</a>
	</div>

	<?php else: ?>

	<div class="post-content">
		<?php
			the_content();
			wp_link_pages(array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'youxi' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			));
		?>
	</div>

	<footer class="post-footer">

		<?php if( $tags = get_the_tags() ): ?>
		<section class="post-footer-row post-footer-row-xs">
			<div class="post-taxonomy">
				<span class="tax-label"><?php _e( 'Tagged', 'youxi' ) ?></span>
				<?php foreach( $tags as $term ): ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ) ?>" class="btn btn-primary btn-xs">
					<?php echo esc_html( $term->name ) ?>
				</a>
				<?php endforeach; ?>
			</div>
		</section>
		<?php endif; ?>

		<?php if( 'on' == ot_get_option( 'blog_show_addthis' ) ): ?>
		<section class="post-footer-row post-footer-row-xs">
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="<?php the_permalink() ?>" addthis:title="<?php the_title_attribute() ?>">
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<a class="addthis_button_print"></a>
				<a class="addthis_button_gmail"></a>
				<a class="addthis_button_compact"></a>
			</div>
		</section>
		<?php endif; ?>

		<?php if( get_the_author_meta( 'description' ) && ( is_multi_author() || 'on' == ot_get_option( 'blog_always_show_author' ) ) ): ?>
		<section class="post-footer-row post-author post-footer-row-sm">
			<figure class="avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ) ?>
			</figure>
			<div class="author-description">
				<h4 class="alt-style text-uppercase"><?php the_author_link() ?></h4>
				<?php the_author_meta( 'description' ) ?>
			</div>
		</section>
		<?php endif; ?>

		<?php //if( 'on' == ot_get_option( 'blog_show_related_posts' ) ): ?>
		<!-- <section class="post-footer-row post-related">
		</section> -->
		<?php //endif; ?>

	</footer>

	<?php endif; ?>
</article>