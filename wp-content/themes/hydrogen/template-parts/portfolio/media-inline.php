<?php
$media = wp_parse_args( (array) $post->media, array( 'images' => array() ) );
if( ! empty( $media['images'] ) ): ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="media">
				<?php echo hydrogen_portfolio_attachment_images( $media['images'], '<figure>', '</figure>' ) ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>