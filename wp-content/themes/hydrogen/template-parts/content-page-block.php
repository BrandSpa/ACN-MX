<?php
/* Parse bg_media */
$bg_media = wp_parse_args( (array) $post->bg_media, array(
	'type' => 0, 
	'image' => '', 
	'image_mode' => 'none', 
	'image_parallax_speed' => 0.3, 
	'video_src' => '', 
	'video_poster' => ''
));

/* Parse page layout attributes */
$layout = wp_parse_args( (array) $post->layout, array(
	'use_builder' => true, 
	'padding_top' => 'full', 
	'padding_bottom' => 'three-quarters'
));

/* Parallax background attributes */
$parallax_attributes = '';
if( 'img' == $bg_media['type'] ) {
	$parallax_attributes = hydrogen_parallax_attributes( $bg_media['image'], $bg_media['image_mode'], $bg_media['image_parallax_speed'] );
}
?><section id="<?php echo esc_attr( $post->post_name ) ?>" <?php post_class( 'section' ); echo $parallax_attributes; ?>>
	
	<div class="section-row-container">
		<?php if( $layout['use_builder'] ):
			the_content();
		else:
		?><div class="section-row <?php echo $layout['padding_top'] ?>-padding-top <?php echo $layout['padding_bottom'] ?>-padding-bottom">
			<div class="container">
				<?php
				$title_meta = wp_parse_args( (array) $post->title, array(
					'visible' => true, 
					'element' => 'h1', 
					'subtitle' => '', 
					'highlight_subtitle' => false, 
					'alignment' => 'left', 
					'show_counter' => true
				));

				if( $title_meta['visible'] ):

					/* Prepare title classes */
					$title_class = 'section-title';
					if( $title_meta['show_counter'] ) {
						$title_class .= ' show-counter';
					}

					if( in_array( $title_meta['alignment'], array( 'center', 'right' ) ) ) {
						$title_class .= ' text-' . $title_meta['alignment'];
					}

					/* Construct title */
					$title_html = '<' . $title_meta['element'] . ' class="' . esc_attr( $title_class ) . '">';

						$title_html .= get_the_title();

						if( $title_meta['subtitle'] ) {

							$title_html .= '<small>';

							if( $title_meta['highlight_subtitle'] ) {
								$title_html .= '<span class="highlight">' . $title_meta['subtitle'] . '</span>';
							} else {
								$title_html .= $title_meta['subtitle'];
							}

							$title_html .= '</small>';

						}

					$title_html .= '</' . $title_meta['element'] . '>';

					if( $title_html ):

				?><div class="row">
					<div class="col-md-12">
						<?php echo $title_html; ?>
					</div>
				</div>
				<?php endif;
				endif;
				?><div class="row">
					<div class="col-md-12">
						<?php the_content() ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<?php if( $bg_media['type'] ): ?>

	<div class="section-overlay"></div>

	<?php if( 'video' == $bg_media['type'] && '' !== $bg_media['video_src'] ):

		// Quick loop to determine the file types
		foreach( array( 'video_src', 'video_poster' ) as $attr ) {
			if( $__att_url = wp_get_attachment_url( $bg_media[ $attr ] ) ) {
				$bg_media[ $attr ] = $__att_url;
			}
		}

	?><div class="section-media section-media-video">
		<div class="aligned-video-wrapper">
			<?php echo wp_video_shortcode(array(
				'src' => $bg_media['video_src'], 
				'poster' => $bg_media['video_poster'], 
				'autoplay' => true, 
				'loop' => true, 
				'width' => '1920', 
				'height' => '1080'
			)); ?>
		</div>
	</div>
	<?php endif;
	
	endif; ?>

</section>