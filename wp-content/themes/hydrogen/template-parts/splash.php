<?php
$html = '';
$splash_attributes = array(
	'class' => 'site-splash'
);
if( $type && 'revslider' != $type ) {
	if( 0 == $height ) {
		$splash_attributes['class'] .= ' fullscreen';
	} else {
		$splash_attributes['style'] = 'height: ' . intval( $height ) . 'px;';
	}
}
foreach( $splash_attributes as $key => $attr ) {
	$html .= " {$key}=\"" . esc_attr( $attr ) . '"';
}
?><section<?php echo $html ?>>

	<div class="splash-inner">

<?php switch( $type ):
	
	/* Revolution Slider */
	case 'revslider':
		if( '' != $revslider_id && function_exists( 'putRevSlider' ) ):
			putRevSlider( $revslider_id );
		endif;
		break;

	/* Custom Content (HTML) */
	case 'custom': ?>
		<div class="splash-custom-content">
			<?php echo $custom_content ?>
		</div>
	<?php break;

	/* Hydrogen Slider */
	case 'slider':
	case 'slider_with_bg':
	default:
		$slide_defaults = array(
			'intro_text' => '', 
			'intro_link' => '', 
			'intro_link_behavior' => 'default', 
			'headline' => '', 
			'description' => '', 
			'background' => false, 
			'background_mode' => 'parallax', 
			'background_parallax_speed' => 0.3
		); ?>
		<div class="splash-slider"<?php if( 4000 != $slider_duration ) echo ' data-timeout="' . esc_attr( $slider_duration ) . '"' ?>>

			<?php foreach( (array) $slider_content as $slide ):
				$slide = wp_parse_args( $slide, $slide_defaults );
			?><div class="splash-content"><?php

				?><div class="container">

					<div class="row">

						<div class="col-md-12">

							<div class="splash-text">

								<?php if( $slide['intro_text'] ): ?>
								<h4 class="splash-intro">
									<?php if( $slide['intro_link'] ): ?>
									<a href="<?php echo esc_url( $slide['intro_link'] ) ?>"><?php echo $slide['intro_text'] ?></a>
									<?php else: ?>
									<span><?php echo $slide['intro_text'] ?></span>
									<?php endif; ?>
								</h4>
								<?php endif; ?>

								<h1 class="splash-headline"><?php echo $slide['headline'] ?></h1>

								<div class="splash-description">
									<?php echo wpautop( $slide['description'] ) ?>
								</div>

							</div>

						</div>

					</div>

				</div>

				<?php if( $slide['background'] ): ?>
				<div class="splash-media"<?php echo hydrogen_parallax_attributes( $slide['background'], $slide['background_mode'], $slide['background_parallax_speed'] ) ?>>
					<div class="overlay"></div>
				</div>
				<?php endif; ?>

			</div>
			<?php endforeach; ?>

			<?php if( count( $slider_content ) > 1 ):
			?><div class="cycle-next"></div>
			<div class="cycle-prev"></div>
			<?php endif; ?>

		</div>

		<?php
		if( 'slider_with_bg' == $type ):

		/* Image Splash Media */
		if( 'img' == $slider_bg ):
		?><div class="splash-media"<?php echo hydrogen_parallax_attributes( $slider_bg_img, $slider_bg_img_mode, $slider_bg_img_parallax_speed ) ?>>
			<div class="overlay"></div>
		</div>
		<?php

		/* Video Splash Media */
		elseif( 'video' == $slider_bg ):

			// Quick loop to determine the file types
			foreach( array( 'slider_bg_video_src', 'slider_bg_video_poster' ) as $attr ) {
				if( $__att_url = wp_get_attachment_url( ${$attr} ) ) {
					${$attr} = $__att_url;
				}
			}

		?><div class="splash-media splash-media-video">
			<div class="overlay"></div>
			<div class="aligned-video-wrapper">
				<?php echo wp_video_shortcode(array(
					'src' => $slider_bg_video_src, 
					'poster' => $slider_bg_video_poster, 
					'autoplay' => true, 
					'loop' => true, 
					'width' => '1920', 
					'height' => '1080'
				)); ?>
			</div>
		</div>
		<?php
		endif;

		endif; ?>

		<?php

		/* Feedback */
		if( '' != $feedback_text ):
		?><div class="splash-feedback">
			<span class="mouse"><span class="fa fa-angle-down"></span></span>
			<span class="caption"><?php echo $feedback_text ?></span>
		</div>
		<?php endif;

endswitch; ?>

	</div>

</section>