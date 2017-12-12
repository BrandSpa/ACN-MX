<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

	<?php if( have_posts() ):

		while( have_posts() ): the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;

	else:

		/* Prepare post classes */
		$post_class = array( 'section' );

		/* Construct post style */
		if( $style = ot_get_option( 'portfolio_style' ) ) {
			$post_class[] = 'style-' . $style;
		}

		/* Construct HTML markup */
		$html = ' class="' . join( ' ', $post_class ) . '"';

		?><section<?php echo $html ?>>

			<div class="section-row-container">

				<div class="section-row">

					<div class="container">

						<div class="row">

							<div class="col-md-12">

								<?php get_template_part( 'template-parts/content', 'none' ) ?>

							</div>

						</div>

					</div>

				</div>
				
			</div>

		</section>
		
	<?php endif; ?>

	</div>

<?php get_footer() ?>