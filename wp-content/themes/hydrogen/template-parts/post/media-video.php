<?php
$meta = hydrogen_extract_post_format_meta();
if( is_array( $meta ) ):

	if( $__att_url = wp_get_attachment_url( $meta['src'] ) ) {
		$meta['src'] = $__att_url;
	}
	if( $__att_url = wp_get_attachment_url( $meta['poster'] ) ) {
		$meta['poster'] = $__att_url;
	}
?><div class="post-media">

<?php switch( $meta['type'] ):
	case 'embed': ?>
	<div class="media embed-responsive embed-responsive-16by9">
		<?php global $wp_embed;
		if( is_a( $wp_embed, 'WP_Embed' ) ):
			echo $wp_embed->autoembed( $meta['embed'] );
		else:
			echo $meta['embed'];
		endif; ?>
	</div>
	<?php break;
	case 'hosted': ?>
	<div class="media">
		<?php echo wp_video_shortcode(array(
			'src' => $meta['src'], 
			'poster' => $meta['poster'], 
			'width' => '1920', 
			'height' => '1080'
		)); ?>
	</div>
	<?php break;
endswitch; ?>

</div>
<?php endif; ?>