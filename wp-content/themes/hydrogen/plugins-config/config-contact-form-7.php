<?php

if( ! function_exists( 'hydrogen_wpcf7_form_class_attr' ) ) {

	function hydrogen_wpcf7_form_class_attr( $class ) {
		return $class . ' form-horizontal';
	}
}
add_filter( 'wpcf7_form_class_attr', 'hydrogen_wpcf7_form_class_attr' );

if( ! function_exists( 'hydrogen_wpcf7_enqueue_scripts' ) ) {

	function hydrogen_wpcf7_enqueue_scripts() {

		$wp_theme = wp_get_theme();
		$theme_version = $wp_theme->exists() ? $wp_theme->get( 'Version' ) : false;

		wp_enqueue_script( 'hydrogen-contact-form-7', 
			get_template_directory_uri() . '/assets/js/hydrogen.wpcf7.js', 
			array( 'contact-form-7' ), 
			$theme_version, true 
		);
	}
}
add_action( 'wpcf7_enqueue_scripts', 'hydrogen_wpcf7_enqueue_scripts' );