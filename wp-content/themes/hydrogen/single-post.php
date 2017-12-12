<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

	<?php if( have_posts() ): the_post();

		/* Prepare post classes */
		$post_class = array( 'section' );

		/* Construct post style based on single post / general blog setting */
		if( ot_get_option( 'blog_style' ) ) {
			$post_style = 'style-' . ot_get_option( 'blog_style' );
		}
		if( is_string( $post->style ) && ! empty( $post->style ) ) {
			$post_style = 'style-' . $post->style;
		}
		if( isset( $post_style ) ) {
			$post_class[] = $post_style;
		}

		/* Construct HTML markup */
		$html = ' class="' . join( ' ', $post_class ) . '"';

		?><section<?php echo $html ?>>

			<div class="section-row-container">

				<div class="section-row three-quarters-padding-bottom">

					<div class="container">

						<div class="row">

							<div class="col-md-12">

								<h1 class="page-title text-center">
									<?php
										the_title();

										if( $post_meta = hydrogen_post_meta() ):
											echo '<small>' . $post_meta . '</small>';
										endif;
									?>
								</h1>

							</div>

						</div>

					</div>

				</div>

				<div class="section-row no-padding-top">

					<div class="container">

						<div class="row">

						<?php
							do_action( 'hydrogen_blog_posts_before' );

							get_template_part( 'template-parts/content', get_post_type() );
							
							if( comments_open() || get_comments_number() ):
								comments_template();
							endif;

							do_action( 'hydrogen_blog_posts_after' );
						?>

						</div>

					</div>

				</div>
				
			</div>

		</section>

	<?php endif; ?>

	</div>

<?php get_footer() ?>