<?php
$media = wp_parse_args( (array) $post->media, array( 'images' => array() ) );
if( ! empty( $media['images'] ) ): ?>
<div class="photoset">
	<?php echo hydrogen_portfolio_attachment_images( $media['images'], '<div class="photo media"><figure>', '</figure></div>' ) ?>
</div>
<?php endif; ?>