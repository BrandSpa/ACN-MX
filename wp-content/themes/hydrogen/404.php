<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

		<?php
		/* Prepare post classes */
		$post_class = array( 'section' );

		/* Construct post style */
		if( $style = ot_get_option( 'page_style' ) ) {
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

								<h1 class="alt-style text-uppercase"><?php _e( 'Error 404', 'youxi' ) ?></h1>
								<h4><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'youxi' ); ?></h4>
								<?php get_search_form(); ?>

							</div>

						</div>

					</div>

				</div>
				
			</div>

		</section>

	</div>

<?php get_footer() ?>
