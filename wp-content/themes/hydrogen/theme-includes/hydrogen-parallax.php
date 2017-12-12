<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Construct parallax attributes markup
 */
if( ! function_exists( 'hydrogen_parallax_attributes' ) ):

function hydrogen_parallax_attributes( $attachment_id, $mode = 'parallax', $speed = '0.3' ) {

	$html = '';
	foreach( array( 'full', 'xs', 'sm', 'md' ) as $size ) {
		if( 'full' == $size ) {
			if( $img = wp_get_attachment_image_src( $attachment_id, $size ) ) {
				$html .= ' data-background="' . esc_url( $img[0] ) . '"';
			}
		} else {
			if( $img = wp_get_attachment_image_src( $attachment_id, 'parallax_img_' . $size ) ) {
				$html .= ' data-background-'. $size . '="' . esc_url( $img[0] ) . '"';
			}
		}
	}

	if( '' !== $html ) {
		if( $speed >= 0.0 && $speed <= 1.0 && 0.3 != $speed && 'parallax' == $mode ) {
			$html .= ' data-speed-factor="' . esc_attr( $speed ) . '"';
		}

		if( in_array( $mode, array( 'none', 'fixed', 'parallax' ) ) ) {
			$html .= ' data-mode="' . esc_attr( $mode ) . '"';
		}
	}

	return $html;
}
endif;

/**
 * Retrieve Parallax Image Sizes
 */
if( ! function_exists( 'hydrogen_add_parallax_image_sizes' ) ):

function hydrogen_add_parallax_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'parallax_img_xs' => array( 'width' => 640 ), 
		'parallax_img_sm' => array( 'width' => 768 ), 
		'parallax_img_md' => array( 'width' => 992 )
	));
}
endif;
add_filter( 'hydrogen_wp_image_sizes', 'hydrogen_add_parallax_image_sizes' );
