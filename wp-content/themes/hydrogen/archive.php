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
										if( is_category() ):
											$strtr = array( '{category}' => single_cat_title( '', false ));
											$ot_prefix = 'blog_category';
										elseif( is_tag() ):
											$strtr = array( '{tag}' => single_tag_title( '', false ));
											$ot_prefix = 'blog_tag';
										elseif( is_author() ):
											$strtr = array( '{author}' => get_the_author() );
											$ot_prefix = 'blog_author';
										elseif( is_day() ):
											$strtr = array( '{date}' => get_the_date( __( 'F d, Y', 'youxi' ) ) );
											$ot_prefix = 'blog_date';
										elseif( is_month() ):
											$strtr = array( '{date}' => get_the_date( __( 'F, Y', 'youxi' ) ) );
											$ot_prefix = 'blog_date';
										elseif( is_year() ):
											$strtr = array( '{date}' => get_the_date( __( 'Y', 'youxi' ) ) );
											$ot_prefix = 'blog_date';
										endif;

										if( isset( $strtr, $ot_prefix ) ):

											echo strtr( ot_get_option( $ot_prefix . '_title' ), $strtr );
											if( $subtitle = ot_get_option( $ot_prefix . '_subtitle' ) ):
												echo '<small>' . strtr( $subtitle, $strtr ) . '</small>';
											endif;

										else:
											esc_html_e( 'Archive', 'youxi' );
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