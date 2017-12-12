<?php
$media = wp_parse_args( (array) $post->media, array(
	'video_type' => 'hosted', 
	'video_embed' => '', 
	'video_src' => '', 
	'video_poster' => ''
));
if( ( 'embed' == $media['video_type'] && '' !== $media['video_embed'] ) || 
	( 'hosted' == $media['video_type'] && '' !== $media['video_src'] ) ):

	if( $__att_url = wp_get_attachment_url( $media['video_src'] ) ) {
		$media['video_src'] = $__att_url;
	}
	if( $__att_url = wp_get_attachment_url( $media['video_poster'] ) ) {
		$media['video_poster'] = $__att_url;
	}
?><div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php switch( $media['video_type'] ):
			case 'embed': ?>
			<div class="media embed-responsive embed-responsive-16by9">
				<?php global $wp_embed;
				if( is_a( $wp_embed, 'WP_Embed' ) ):
					echo $wp_embed->autoembed( $media['video_embed'] );
				else:
					echo $media['video_embed'];
				endif; ?>
			</div>
			<?php break;
			case 'hosted': ?>
			<div class="media">
				<?php echo wp_video_shortcode(array(
					'src' => $media['video_src'], 
					'poster' => $media['video_poster'], 
					'width' => '1920', 
					'height' => '1080'
				)); ?>
			</div>
			<?php break;
		endswitch; ?>
		</div>
	</div>
</div>
<?php endif; ?>