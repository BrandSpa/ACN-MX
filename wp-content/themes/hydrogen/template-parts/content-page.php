<?php
/* Parse page title attributes */
$title = wp_parse_args( (array) $post->title, array(
	'visible' => true, 
	'alignment' => 'center', 
	'subtitle' => '', 
	'padding_top' => 'full', 
	'padding_bottom' => 'three-quarters'
));

/* Parse page layout attributes */
$layout = wp_parse_args( (array) $post->layout, array(
	'use_builder' => true, 
	'padding_top' => 'full', 
	'padding_bottom' => 'three-quarters'
));

?><section id="<?php echo esc_attr( $post->post_name ) ?>" <?php post_class( 'section' ) ?>>

	<div class="section-row-container">

		<?php if( $title['visible'] ): ?>
		<div class="section-row <?php echo $title['padding_top'] ?>-padding-top <?php echo $title['padding_bottom'] ?>-padding-bottom">

			<div class="container">

				<div class="row">

					<div class="col-md-12">

						<h1 class="page-title text-<?php echo $title['alignment'] ?>">
							<?php the_title() ?>
							<?php if( $title['subtitle'] ) echo '<small>' . $title['subtitle'] . '</small>' ?>
						</h1>

					</div>

				</div>

			</div>

		</div>
		<?php endif;

		if( $layout['use_builder'] ):
			the_content();
		else:
		?><div class="section-row <?php echo $layout['padding_top'] ?>-padding-top <?php echo $layout['padding_bottom'] ?>-padding-bottom">

			<div class="container">

				<div class="row">

					<div class="col-md-12">

					<?php
						the_content();
						wp_link_pages(array(
							'before'      => '<ul class="pagination pagination-sm"><li>',
							'after'       => '</li></ul>'
						));
					?>

					</div>

				</div>

			</div>

		</div>
		<?php endif; ?>
	</div>

</section>