<?php
$media = wp_parse_args( (array) $post->media, array( 'images' => array() ) );
if( ! empty( $media['images'] ) ): ?>
<div class="nearby-slider">
	<div class="royalSlider rsHydrogen" data-image-scale-mode="fit">
		<?php echo hydrogen_portfolio_attachment_images( $media['images'], '<div class="slider-media"><figure>', '</figure></div>', array( 'class' => 'rsImg' ) ) ?>
	</div>
</div>
<?php endif; ?>