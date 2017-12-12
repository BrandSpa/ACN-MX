<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_POST_FORMAT_VERSION' ) ) {
	return;
}

// Filter post format meta keys for compatibility
function hydrogen_post_format_aside_id( $id ) {
	return 'youxi_pf_aside';
}
add_filter( 'youxi_post_format_aside_id', 'hydrogen_post_format_aside_id' );

function hydrogen_post_format_image_id( $id ) {
	return 'youxi_pf_image';
}
add_filter( 'youxi_post_format_image_id', 'hydrogen_post_format_image_id' );

function hydrogen_post_format_video_id( $id ) {
	return 'youxi_pf_video';
}
add_filter( 'youxi_post_format_video_id', 'hydrogen_post_format_video_id' );

function hydrogen_post_format_audio_id( $id ) {
	return 'youxi_pf_audio';
}
add_filter( 'youxi_post_format_audio_id', 'hydrogen_post_format_audio_id' );

function hydrogen_post_format_quote_id( $id ) {
	return 'youxi_pf_quote';
}
add_filter( 'youxi_post_format_quote_id', 'hydrogen_post_format_quote_id' );

function hydrogen_post_format_link_id( $id ) {
	return 'youxi_pf_link';
}
add_filter( 'youxi_post_format_link_id', 'hydrogen_post_format_link_id' );

function hydrogen_post_format_gallery_id( $id ) {
	return 'youxi_pf_gallery';
}
add_filter( 'youxi_post_format_gallery_id', 'hydrogen_post_format_gallery_id' );
