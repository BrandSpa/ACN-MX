<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

/**
 * Youxi Styles Manager class
 *
 * This class registers, attaches and compile styles from a LESS file.
 *
 * @package   Youxi Themes
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014, Mairel Theafila
 */

final class Youxi_Styles_Manager {

	private static $_instance;

	private $_styles = array();

	private function __construct() {}

	public static function get() {
		if( ! self::$_instance ) {
			self::$_instance = new Youxi_Styles_Manager();
		}

		return self::$_instance;
	}

	public function get_less_vars() {
		return apply_filters( 'youxi_styles_manager_less_vars', wp_list_pluck( $this->_styles, 'vars' ) );
	}

	public function register_style( $name, $label, $vars ) {
		$this->_styles[ $name ] = compact( 'label', 'vars' );
		return $this;
	}

	public function get_styles() {
		return $this->_styles;
	}

	public function get_styles_list() {
		$default = array( 0 => __( 'Default', 'youxi' ) );

		return array_merge( $default, wp_list_pluck( $this->_styles, 'label' ) );
	}
}
