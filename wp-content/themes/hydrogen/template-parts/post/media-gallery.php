<?php
$meta = hydrogen_extract_post_format_meta();
if( is_array( $meta ) ):
?><div class="post-media">

	<div class="standard-slider standard-slider-16-9">

		<div class="royalSlider rsHydrogen">

			<?php

			// Trigger caching to reduce SQL queries
			hydrogen_trigger_attachments_caching( $meta['images'] );

			foreach( $meta['images'] as $image ):
				if( ! ( $img_url = wp_get_attachment_image_src( $image, 'full' ) ) ):
					continue;
				endif;
			?><div class="slider-media">
				<figure>
					<?php echo wp_get_attachment_image( $image, 'full', false, array( 'class' => 'rsImg' ) ); ?>
				</figure>
				<div class="overlay">
					<ul>
						<li class="mfp-zoom">
							<a href="<?php echo esc_url( $img_url[0] ) ?>">
								<i class="gi gi-resize-full"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<?php endforeach; ?>

		</div>
		
	</div>

</div>
<?php endif; ?>