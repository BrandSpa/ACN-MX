<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Include all the needed files
 *
 * (!) Note for Clients: please, do not modify this or other theme's files. Use child theme instead!
 */

if ( ! defined( 'US_ACTIVATION_THEMENAME' ) ) {
	define( 'US_ACTIVATION_THEMENAME', 'Impreza' );
}

// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
     
    //.. Code from other Tutorials ..//
 
    // Require new custom Element
   require_once( get_template_directory().'/vc-elements/my-first-custom-element.php' ); 
     
}

function create_posttype() {

	register_post_type( 'donaciones',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Donaciones' ),
				'singular_name' => __( 'Donacion' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'donaciones'),
			'menu_icon'           => 'dashicons-cart',

		)
	);




}
// Hooking up our function to theme setup

add_action( 'init', 'create_posttype' );

function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/js/wp-admin.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');

$us_theme_supports = array(
	'plugins' => array(
		'js_composer' => '/framework/plugins-support/js_composer/js_composer.php',
		'Ultimate_VC_Addons' => '/framework/plugins-support/Ultimate_VC_Addons.php',
		'revslider' => '/framework/plugins-support/revslider.php',
		'contact-form-7' => NULL,
		'gravityforms' => '/framework/plugins-support/gravityforms.php',
		'woocommerce' => '/framework/plugins-support/woocommerce/woocommerce.php',
		'codelights' => '/framework/plugins-support/codelights.php',
		'wpml' => '/framework/plugins-support/wpml.php',
		'bbpress' => '/framework/plugins-support/bbpress.php',
		'tablepress' => '/framework/plugins-support/tablepress.php',
		'the-events-calendar' => '/framework/plugins-support/the_events_calendar.php',
		'us-header-builder' => '/framework/plugins-support/us_header_builder.php',
	),
);

require dirname( __FILE__ ) . '/framework/framework.php';

unset( $us_theme_supports );

