<div class="media embed-responsive embed-responsive-16by9">
	<?php global $wp_embed;
	if( is_a( $wp_embed, 'WP_Embed' ) ):
		echo $wp_embed->autoembed( $embed_code );
	else:
		echo $embed_code;
	endif; ?>
</div>