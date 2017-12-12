<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

if( ! class_exists( 'Youxi_Font' ) ) {
	require( dirname( __FILE__ ) . '/class-font.php' );
}

/**
 * Youxi Fonts Manager class
 *
 * This class provides the functionality to manage fonts which can be 
 * self hosted fonts or Google Fonts that later can be enqueued on the frontend.
 *
 * @package   Youxi Themes
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014, Mairel Theafila
 */

final class Youxi_Fonts_Manager {

	private static $_instance;

	private $_fonts = array();

	private function __construct() {}

	public static function get() {

		if( ! is_a( self::$_instance, get_class() ) ) {
			self::$_instance = new Youxi_Fonts_Manager();
		}
		return self::$_instance;
	}

	public function add_font( $font, $replace_existing = true ) {

		/* Only proceed if the supplied argument is a font */
		if( is_a( $font, 'Youxi_Font' ) ) {

			/* Keep track of the fonts using their IDs */
			if( $replace_existing || ! $this->has_font( $font->id() ) ) {
				$this->_fonts[ $font->id() ] = $font;
			}
		}

		return $this;
	}

	public function get_font( $id ) {
		if( isset( $this->_fonts[ $id ] ) ) {
			return $this->_fonts[ $id ];
		}
	}

	public function has_font( $id ) {
		return isset( $this->_fonts[ $id ] ) && is_a( $this->_fonts[ $id ], 'Youxi_Font' );
	}

	public function remove_font( $id ) {
		unset( $this->_fonts[ $id ] );
		return $this;
	}

	public function get_css_font_style_args( $id ) {
		$font = $this->get_font( $id );
		if( is_a( $font, 'Youxi_CSS_Font' ) ) {
			return $font->style();
		}
	}

	public function get_css_fonts_style_args() {
		$styles = array();
		foreach( $this->_fonts as $id => $font ) {
			$style = $this->get_css_font_style_args( $id );
			if( is_array( $styles ) ) {
				$styles[ $font->id() ] = $style;
			}
		}
		return $styles;
	}

	public function get_google_fonts_request_url( $include_api_url = true ) {

		$request = array();
		foreach( $this->_fonts as $font ) {
			if( is_a( $font, 'Youxi_Google_Font' ) ) {
				$request[] = $font->url();
			}
		}

		return $include_api_url ? '//fonts.googleapis.com/css?family=' . implode( '|', $request ) : implode( '|', $request );
	}
}