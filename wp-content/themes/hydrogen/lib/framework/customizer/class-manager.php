<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Manager Base Class
 *
 * This class provides the base class for themes to extend
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

abstract class Youxi_Customize_Manager {

	/**
	 * Theme mod prefix
	 */
	private $_prefix;

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'pre_customize' ));
	}
	
	public function prefix() {
		if( ! empty( $this->_prefix ) ) {
			return $this->_prefix;
		}
		$theme = wp_get_theme();
		return ( $this->_prefix = preg_replace( '/\W/', '_', $theme->stylesheet ) . '_settings' );
	}

	public function pre_customize( $wp_customize ) {
		require_once( 'controls/class-gallery-control.php' );
		require_once( 'controls/class-google-font-control.php' );
		require_once( 'controls/class-multicheck-control.php' );
		require_once( 'controls/class-range-control.php' );
		require_once( 'controls/class-sortable-control.php' );
		require_once( 'controls/class-switch-control.php' );
	}

	public static function sanitize_boolean( $value ) {
		return (bool) $value;
	}
}
