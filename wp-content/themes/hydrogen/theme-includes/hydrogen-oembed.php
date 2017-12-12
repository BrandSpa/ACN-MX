<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Keep track of all fetched WP_oEmbed data
 */
if( ! function_exists( 'hydrogen_oembed_dataparse' ) ):

function hydrogen_oembed_dataparse( $return, $data, $url ) {

	if( ! isset( $GLOBALS['hydrogen_oembed_cache'] ) ) {
		$GLOBALS['hydrogen_oembed_cache'] = get_option( '_hydrogen_oembed_cache', array() );
	}

	if( ! isset( $GLOBALS['hydrogen_oembed_cache'][ $url ] ) && is_object( $data ) && ! empty( $data->type ) ) {

		$GLOBALS['hydrogen_oembed_cache'][ $url ] = $data;

		if( ! add_option( '_hydrogen_oembed_cache', $GLOBALS['hydrogen_oembed_cache'], '', 'no' ) ) {
			update_option( '_hydrogen_oembed_cache', $GLOBALS['hydrogen_oembed_cache'] );
		}
	}

	return $return;
}
endif;
add_filter( 'oembed_dataparse', 'hydrogen_oembed_dataparse', 10, 3 );

/**
 * Retrieve an oEmbed data cache
 */
if( ! function_exists( 'hydrogen_get_oembed_cache' ) ):

function hydrogen_get_oembed_cache( $url ) {
	return isset( $GLOBALS['hydrogen_oembed_cache'], $GLOBALS['hydrogen_oembed_cache'][ $url ] ) ? 
		$GLOBALS['hydrogen_oembed_cache'][ $url ] : null;
}
endif;
