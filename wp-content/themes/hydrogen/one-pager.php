<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

		<?php if( have_posts() ): the_post();

			$blocks = Youxi_One_Pager::get_blocks( $post, true );

			global $post;
			$tmp_post = $post;

			/* First we'll trigger caching of page blocks parallax backgrounds, if any */
			$parallax_bg = array();
			foreach( $blocks as $post ) {
				$bg_media = $post->bg_media;
				if( is_array( $bg_media ) && isset( $bg_media['type'], $bg_media['image'] ) && 'img' == $bg_media['type'] ) {
					$parallax_bg[] = $bg_media['image'];
				}
			}
			hydrogen_trigger_attachments_caching( $parallax_bg );

			/* Render page blocks */
			foreach( $blocks as $post ): setup_postdata( $post );
				get_template_part( 'template-parts/content', get_post_type() );
			endforeach;
			
			/* Restore the previous post */
			$post = $tmp_post;
			if( is_a( $post, 'WP_Post' ) ) {
				setup_postdata( $post );
			}

		endif; ?>

	</div>

<?php get_footer() ?>