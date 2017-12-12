<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Utils
 *
 * This class provides useful helper functions
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

final class Youxi_Utils {

	public static function wrap_html( $content, $tag, $attr = array() ) {
		return '<' . $tag . self::attr2html( $attr ) . '>' . $content . '</' . $tag . '>';
	}

	public static function attr2html( $attr ) {

		$html = '';
		foreach( (array) $attr as $key => $val ) {
			if( is_string( $val ) && ! is_numeric( $key ) ) {
				$html .= ' ' . $key . '="' . esc_attr( $val ) . '"';
			}
		}

		return $html;
	}

	public static function json_attr( $object ) {
		return esc_attr( json_encode( $object ) );
	}

}
