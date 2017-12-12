<?php
$media = wp_parse_args( (array) $post->media, array(
	'audio_type' => 'hosted', 
	'audio_embed' => '', 
	'audio_src' => ''
));
if( ( 'embed' == $media['audio_type'] && '' !== $media['audio_embed'] ) || 
	( 'hosted' == $media['audio_type'] && '' !== $media['audio_src'] ) ):

	if( $__att_url = wp_get_attachment_url( $media['audio_src'] ) ) {
		$media['audio_src'] = $__att_url;
	}
?><div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="media">
				<?php switch( $media['audio_type'] ):
					case 'embed':
						global $wp_embed;
						if( is_a( $wp_embed, 'WP_Embed' ) ):
							echo $wp_embed->autoembed( $media['audio_embed'] );
						else:
							echo $media['audio_embed'];
						endif;
						break;
					case 'hosted':
						echo wp_audio_shortcode(array(
							'src' => $media['audio_src']
						));
						break;
				endswitch; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
