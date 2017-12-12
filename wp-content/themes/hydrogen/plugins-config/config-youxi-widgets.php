<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_WIDGETS_VERSION' ) ) {
	return;
}

/* ==========================================================================
	Youxi Widgets plugin config
============================================================================= */

/**
 * Disable Enqueuing Scripts
 */
add_filter( 'youxi_widgets_social-widget_enqueue_scripts', '__return_false' );
add_filter( 'youxi_widgets_tweets-widget_enqueue_scripts', '__return_false' );
add_filter( 'youxi_widgets_allow_tweets-widget_setup', '__return_false' );

/**
 * Disable Widgets temporarily
 */
add_filter( 'youxi_widgets_use_recent_posts', '__return_false' );
add_filter( 'youxi_widgets_use_quote', '__return_false' );
add_filter( 'youxi_widgets_use_rotating_quotes', '__return_false' );

/**
 * Fetch Twitter Keys from Theme Options
 */
if( ! function_exists( 'hydrogen_widgets_twitter_keys' ) ):

function hydrogen_widgets_twitter_keys( $keys ) {
	if( function_exists( 'ot_get_option' ) ) {
		return array(
			'consumer_key' => ot_get_option( 'consumer_key' ), 
			'consumer_secret' => ot_get_option( 'consumer_secret' ), 
			'oauth_token' => ot_get_option( 'access_token' ), 
			'oauth_token_secret' => ot_get_option( 'access_token_secret' )
		);
	}

	return $keys;
}
endif;
add_filter( 'youxi_widgets_twitter_keys', 'hydrogen_widgets_twitter_keys' );

/**
 * Set Widget Templates Directory
 */
if( ! function_exists( 'hydrogen_widgets_template_dir' ) ):

function hydrogen_widgets_template_dir( $path ) {
	return trailingslashit( 'widget-templates' );
}
endif;
add_filter( 'youxi_widgets_template_dir', 'hydrogen_widgets_template_dir' );

/**
 * Match Widget Area Locations
 */
if( ! function_exists( 'hydrogen_widget_sidebar_location' ) ) {

	function hydrogen_widget_sidebar_location( $sidebar_id ) {
		$regexes = array(
			'/^footer_widget_area_\d+$/' => 'footer'
		);

		foreach( $regexes as $regex => $location ) {
			if( preg_match( $regex, $sidebar_id ) ) {
				return $location;
			}
		}

		return 'sidebar';
	}
}
add_filter( 'youxi_widgets_sidebar_location', 'hydrogen_widget_sidebar_location' );
