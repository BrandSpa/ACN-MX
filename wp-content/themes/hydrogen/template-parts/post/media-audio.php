<?php
$meta = hydrogen_extract_post_format_meta();
if( is_array( $meta ) ):

	if( $__att_url = wp_get_attachment_url( $meta['src'] ) ) {
		$meta['src'] = $__att_url;
	}
?><div class="post-media">

	<div class="media">
		
		<?php switch( $meta['type'] ):
			case 'embed':
				global $wp_embed;
				if( is_a( $wp_embed, 'WP_Embed' ) ):
					echo $wp_embed->autoembed( $meta['embed'] );
				else:
					echo $meta['embed'];
				endif;
				break;
			case 'hosted':
				echo wp_audio_shortcode(array(
					'src' => $meta['src']
				));
				break;
		endswitch; ?>

	</div>

</div>
<?php endif; ?>