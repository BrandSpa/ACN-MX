<?php if( has_post_thumbnail() ):
	$thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	
?><div class="post-media">
	<div class="media">
		<figure>
			<?php the_post_thumbnail() ?>
		</figure>
		<div class="overlay">
			<ul>
				<li class="mfp-zoom">
					<a href="<?php echo esc_url( $thumbnail_url[0] ) ?>" title="<?php the_title_attribute() ?>">
						<i class="gi gi-resize-full"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>