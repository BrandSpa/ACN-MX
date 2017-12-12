<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

		<?php
		/* Prepare post classes */
		$post_class = array( 'section' );

		/* Construct post style */
		if( $style = ot_get_option( 'blog_style' ) ) {
			$post_class[] = 'style-' . $style;
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
										echo ot_get_option( 'blog_title' );

										if( $subtitle = ot_get_option( 'blog_subtitle' ) ):
											echo '<small>' . $subtitle . '</small>';
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
							if( have_posts() ):
							?>
							<div class="posts-wrap">

								<?php while( have_posts() ) : the_post();
									get_template_part( 'template-parts/content', get_post_type() );
								endwhile; ?>

							</div>
							<?php else:
								get_template_part( 'template-parts/content', 'none' );
							endif;
							do_action( 'hydrogen_blog_posts_after' );
						?>

						</div>

					</div>

				</div>
				
			</div>

		</section>

	</div>

<?php get_footer() ?>