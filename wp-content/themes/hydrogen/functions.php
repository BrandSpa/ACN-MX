<?php

/* ==========================================================================
	Load Classes
============================================================================= */

if( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	require( get_template_directory() . '/lib/vendor/class-tgm-plugin-activation.php' );
}

if( ! class_exists( 'Youxi_Demo_Importer_Page' ) ) {
	require( get_template_directory() . '/lib/importer/class-importer.php' );
}

if( ! class_exists( 'Youxi_Styles_Manager' ) ) {
	require( get_template_directory() . '/lib/class-styles-manager.php' );
}

if( ! is_admin() ) {
	
	if( ! class_exists( 'Youxi_Fonts_Manager' ) ) {
		require( get_template_directory() . '/lib/class-fonts-manager.php' );
	}
}

/* ==========================================================================
	Setup Global Vars
============================================================================= */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/* ==========================================================================
	Option Tree Setup
============================================================================= */

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', defined( 'WP_DEBUG' ) && WP_DEBUG ? '__return_true' : '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Optional: set 'ot_theme_options_parent_slug' filter to null.
 * This will move the Theme Options menu to the top level menu
 */
add_filter( 'ot_theme_options_parent_slug', '__return_null' );

/**
 * This will determine the Theme Options menu position
 */
add_filter( 'ot_theme_options_position', create_function( '', 'return 50;' ) );

/**
 * Optional: set 'ot_meta_boxes' filter to false.
 * This will disable the inclusion of OT_Meta_Box
 */
add_filter( 'ot_meta_boxes', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require( get_template_directory() . '/option-tree/ot-loader.php' );

/**
 * Include OptionTree Theme Options.
 */
require( get_template_directory() . '/theme-options.php' );

/* ==========================================================================
	TGMPA Setup
============================================================================= */

add_action( 'tgmpa_register', 'hydrogen_tgmpa_register' );

/**
 * Register the required plugins for this theme.
 *
 */
function hydrogen_tgmpa_register() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     => 'Youxi Core', 
			'slug'     => 'youxi-core', 
			'source'   => get_template_directory() . '/plugins/youxi-core.zip', 
			'required' => true, 
			'version'  => '1.4.2'
		), 
		array(
			'name'     => 'Youxi One Pager', 
			'slug'     => 'youxi-one-pager', 
			'source'   => get_template_directory() . '/plugins/youxi-one-pager.zip', 
			'required' => true, 
			'version'  => '1.2.1'
		), 
		array(
			'name'     => 'Youxi Page Builder', 
			'slug'     => 'youxi-builder', 
			'source'   => get_template_directory() . '/plugins/youxi-builder.zip', 
			'required' => false, 
			'version'  => '2.4.1'
		), 
		array(
			'name'     => 'Youxi Portfolio', 
			'slug'     => 'youxi-portfolio', 
			'source'   => get_template_directory() . '/plugins/youxi-portfolio.zip', 
			'required' => true, 
			'version'  => '1.3'
		), 
		array(
			'name'     => 'Youxi Post Format', 
			'slug'     => 'youxi-post-format', 
			'source'   => get_template_directory() . '/plugins/youxi-post-format.zip', 
			'required' => false, 
			'version'  => '1.1.2'
		), 
		array(
			'name'     => 'Youxi Shortcode', 
			'slug'     => 'youxi-shortcode', 
			'source'   => get_template_directory() . '/plugins/youxi-shortcode.zip', 
			'required' => true, 
			'version'  => '3.2'
		), 
		array(
			'name'     => 'Youxi Widgets', 
			'slug'     => 'youxi-widgets', 
			'source'   => get_template_directory() . '/plugins/youxi-widgets.zip', 
			'required' => false, 
			'version'  => '1.5.2'
		), 
		array(
			'name'     => 'Revolution Slider', 
			'slug'     => 'revslider', 
			'source'   => get_template_directory() . '/plugins/revslider.zip', 
			'required' => false, 
			'version'  => '5.1'
		), 
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		)
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'is_automatic' => true
	);

	tgmpa( $plugins, $config );
}

/* ==========================================================================
	Check for Theme Updates
============================================================================= */

function hydrogen_check_theme_updates( $updates ) {

	if( isset( $updates->checked ) ) {

		/* Get Envato username and API key */
		$envato_username = ot_get_option( 'envato_username' );
		$envato_apikey   = ot_get_option( 'envato_api_key' );

		if( '' !== $envato_username && '' !== $envato_apikey ) {
			if( ! class_exists( 'Pixelentity_Themes_Updater' ) ) {
				require( dirname( __FILE__ ) . '/lib/class-pixelentity-themes-updater.php' );
			}

			$updater = new Pixelentity_Themes_Updater( $envato_username, $envato_apikey );
			$updates = $updater->check( $updates );
		}
	}

	return $updates;
}
add_filter( 'pre_set_site_transient_update_themes', 'hydrogen_check_theme_updates' );

/* ==========================================================================
	Keep track of Scripts and Styles
============================================================================= */

function hydrogen_get_scripts( $include ) {

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	$scripts = array(
		'hydrogen-project' => array(
			'src' => get_template_directory_uri() . "/assets/js/hydrogen.project{$suffix}.js", 
			'deps' => array( 'jquery' ), 
			'ver' => '1.0', 
			'in_footer' => true
		), 
		'royalslider' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/royalslider/jquery.royalslider.min.js", 
			'deps' => array( 'jquery' ), 
			'ver' => '9.5.6', 
			'in_footer' => true
		), 
		'isotope' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/isotope/isotope.pkgd{$suffix}.js", 
			'deps' => array( 'jquery' ), 
			'ver' => '2.2.2', 
			'in_footer' => true
		), 
		'owl-carousel' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/owlcarousel/owl.carousel{$suffix}.js", 
			'deps' => array( 'jquery' ), 
			'ver' => '1.3.2', 
			'in_footer' => true
		), 
		'magnific-popup' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/mfp/jquery.mfp-1.0.0{$suffix}.js", 
			'deps' => array( 'jquery' ), 
			'ver' => '1.0.0', 
			'in_footer' => true
		)
	);

	return array_intersect_key( $scripts, array_flip( (array) $include ) );
}

function hydrogen_get_styles( $include ) {

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	$styles = array(
		'royalslider' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/royalslider/royalslider{$suffix}.css", 
			'deps' => array(), 
			'ver' => '1.0.5', 
			'media' => 'screen'
		), 
		'owl-carousel' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/owlcarousel/owl.carousel{$suffix}.css", 
			'deps' => array(), 
			'ver' => '1.3.2', 
			'media' => 'screen'
		), 
		'magnific-popup' => array(
			'src' => get_template_directory_uri() . "/assets/plugins/mfp/jquery.mfp.css", 
			'deps' => array(), 
			'ver' => '1.0.0', 
			'media' => 'screen'
		)
	);

	return array_intersect_key( $styles, array_flip( (array) $include ) );
}

/* ==========================================================================
	Include Plugin Configurations
============================================================================= */

require( get_template_directory() . '/plugins-config/config-contact-form-7.php' );

require( get_template_directory() . '/plugins-config/config-youxi-core.php' );

require( get_template_directory() . '/plugins-config/config-youxi-one-pager.php' );

require( get_template_directory() . '/plugins-config/config-youxi-portfolio.php' );

require( get_template_directory() . '/plugins-config/config-youxi-post-format.php' );

require( get_template_directory() . '/plugins-config/config-youxi-shortcodes.php' );

require( get_template_directory() . '/plugins-config/config-youxi-widgets.php' );

/* ==========================================================================
	Include Theme Functions
============================================================================= */

require( get_template_directory() . '/theme-includes/hydrogen-default-styles.php' );

require( get_template_directory() . '/theme-includes/hydrogen-demo.php' );

require( get_template_directory() . '/theme-includes/hydrogen-functions.php' );

require( get_template_directory() . '/theme-includes/hydrogen-icons.php' );

require( get_template_directory() . '/theme-includes/hydrogen-oembed.php' );

require( get_template_directory() . '/theme-includes/hydrogen-parallax.php' );

require( get_template_directory() . '/theme-includes/hydrogen-portfolio.php' );

require( get_template_directory() . '/theme-includes/hydrogen-posts.php' );

require( get_template_directory() . '/theme-includes/hydrogen-templates.php' );

require( get_template_directory() . '/theme-includes/hydrogen-typography.php' );

require( get_template_directory() . '/theme-includes/hydrogen-wp.php' );

/* EOF */
