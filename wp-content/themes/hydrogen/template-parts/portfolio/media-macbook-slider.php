<?php
$media = wp_parse_args( (array) $post->media, array( 'images' => array() ) );
if( ! empty( $media['images'] ) ): ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="macbook-slider">
				<div class="wrap">
					<div class="royalSlider rsHydrogen">
						<?php echo hydrogen_portfolio_attachment_images( $media['images'], '<div class="slider-media"><figure>', '</figure></div>', array( 'class' => 'rsImg' ) ) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>