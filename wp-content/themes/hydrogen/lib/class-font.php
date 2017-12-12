<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );
}

/**
 * Youxi Font class
 *
 * This class wraps font data to ease usage in the Font Manager.
 * Fonts can be either self hosted or Google Font.
 *
 * @package   Youxi Themes
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014, Mairel Theafila
 */

abstract class Youxi_Font {

	protected $id;

	protected $css_font_family;

	public function __construct( $id, $css_font_family ) {
		$this->id = $id;
		$this->css_font_family = $css_font_family;
	}

	public function id() {
		return $this->id;
	}

	public function font_family() {
		return $this->css_font_family;
	}

}

class Youxi_CSS_Font extends Youxi_Font {

	protected $style = array();

	public function __construct( $id, $css_font_family, $style ) {

		parent::__construct( $id, $css_font_family );

		$this->style = $style;
	}

	public function style() {
		return wp_parse_args( $this->style, array(
			'handle' => $this->id(), 
			'src' => false, 
			'deps' => array(), 
			'ver' => false, 
			'media' => 'all'
		));
	}
}

final class Youxi_Google_Font extends Youxi_Font {

	private static $_google_fonts;

	private $family;

	private $variants = array();

	private $subsets = array();

	private $instance = null;

	public function __construct( $id, $css_font_family, $family, $variants = array(), $subsets = array() ) {

		parent::__construct( $id, $css_font_family );

		$this->prepare( $family, $variants, $subsets );
	}

	public function is_valid() {
		return ! empty( $this->instance );
	}
	
	public function url() {

		if( ! $this->is_valid() ) {
			return '';
		}

		$url = self::family2id( $this->family );

		if( is_array( $this->variants ) && ! empty( $this->variants ) ) {
			$url .= ':' . implode( ',', $this->variants );
		}

		if( is_array( $this->subsets ) && ! empty( $this->subsets ) ) {
			$url .= '&subset=' . implode( ',', $this->subsets );
		}

		return $url;
	}

	public function update( $args ) {

		if( ! $this->is_valid() ) {
			return;
		}

		/* Update from another Google Font */
		if( is_a( $args, get_class() ) ) {

			/* Only update if it's the same font */
			if( $args->family == $this->family ) {
				$args = array(
					'variants' => $args->variants, 
					'subsets'  => $args->subsets
				);
			} else {
				return;
			}
		}

		if( is_array( $args ) ) {

			if( isset( $args['variants'] ) && is_array( $args['variants'] ) ) {
				if( is_array( $this->variants ) ) {
					$this->variants = array_merge( $this->variants, $args['variants'] );
				} else {
					$this->variants = $args['variants'];
				}
				$this->variants = array_unique( array_intersect( $this->instance['variants'], $this->variants ) );
			}

			if( isset( $args['subsets'] ) && is_array( $args['subsets'] ) ) {
				if( is_array( $this->subsets ) ) {
					$this->subsets = array_merge( $this->subsets, $args['subsets'] );
				} else {
					$this->subsets = $args['subsets'];
				}
				$this->subsets = array_unique( array_intersect( $this->instance['subsets'], $this->subsets ) );
			}
		}
	}

	private function prepare( $family, $variants, $subsets ) {

		/* Search for a matching Google font */
		if( ( $google_font = self::fetch( $family ) ) && is_array( $google_font ) ) {

			/* Make sure to properly set the font family */
			$this->family = self::id2family( $family );

			/* Keep original copy of the google font */
			$this->instance = wp_parse_args( $google_font, array(
				'family' => '', 
				'variants' => array(), 
				'subsets' => array()
			));

			if( ! empty( $variants ) ) {
				$this->variants = array_intersect( $this->instance['variants'], $variants );
			} else {
				$this->variants = array();
			}
			$this->variants = array_unique( $this->variants );

			if( ! empty( $subsets ) ) {
				$this->subsets = array_intersect( $this->instance['subsets'], $subsets );
			} else {
				$this->subsets = array();
			}
			$this->subsets = array_unique( $this->subsets );
		}
	}

	public static function fetch( $id_or_family = false ) {

		/* Return cached google fonts to speed up things */
		if( is_array( self::$_google_fonts ) && ! empty( self::$_google_fonts ) ) {

			$return = self::$_google_fonts;

		} else {

			/* Try to get Google Fonts first in case some external code provides the fonts */
			$google_fonts = apply_filters( 'youxi_google_fonts_cache', array() );

			/* If no fonts are fetched, get it from cache */
			if( empty( $google_fonts ) ) {

				/* Google Fonts cache key */
				$google_fonts_cache_key = apply_filters( 'youxi_google_fonts_cache_key', 'youxi_google_fonts_cache' );
				$google_fonts = get_transient( $google_fonts_cache_key );
			}

			/* If we still don't have the fonts, let's get it directly from Google */
			if ( ! is_array( $google_fonts ) || empty( $google_fonts ) ) {

				$google_fonts = array();

				/* API url and key */
				$google_fonts_api_url = apply_filters( 'youxi_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts' );
				$google_fonts_api_key = apply_filters( 'youxi_google_fonts_api_key', '' );

				/* API arguments */
				$google_fonts_fields = apply_filters( 'youxi_google_fonts_fields', array( 'family', 'variants', 'subsets' ) );
				$google_fonts_sort   = apply_filters( 'youxi_google_fonts_sort', 'popularity' );

				/* Initiate API request */
				$google_fonts_query_args = array(
					'key'    => $google_fonts_api_key, 
					'fields' => 'items(' . implode( ',', $google_fonts_fields ) . ')', 
					'sort'   => $google_fonts_sort
				);

				/* Build and make the request */
				$google_fonts_query = add_query_arg( $google_fonts_query_args, $google_fonts_api_url );
				$google_fonts_response = wp_safe_remote_get( $google_fonts_query, array( 'sslverify' => false, 'timeout' => 15 ) );

				/* continue if we got a valid response */
				if ( 200 == wp_remote_retrieve_response_code( $google_fonts_response ) ) {

					if ( $response_body = wp_remote_retrieve_body( $google_fonts_response ) ) {

						/* JSON decode the response body and cache the result */
						$google_fonts_data = json_decode( trim( $response_body ), true );

						if ( is_array( $google_fonts_data ) && isset( $google_fonts_data['items'] ) ) {

							$google_fonts = $google_fonts_data['items'];

							set_transient( $google_fonts_cache_key, $google_fonts, WEEK_IN_SECONDS );

						}

					}

				}

			}

			/* Get the Google font keys */
			$google_font_keys = array_map( array( get_class(), 'family2id' ), wp_list_pluck( $google_fonts, 'family' ) );
			
			$return = ( self::$_google_fonts = array_combine( $google_font_keys, $google_fonts ) );
		}

		if( isset( $return ) && is_array( $return ) && false !== $id_or_family ) {

			$id_or_family = self::family2id( $id_or_family );

			if( isset( $return[ $id_or_family ] ) ) {
				return $return[ $id_or_family ];
			}
		}

		return $return;
	}

	public static function normalize_weights( $variant ) {
		
		return strtr( $variant, array(
			'regular' => '400', 
			'bold'    => '700', 
			'italic'  => ''
		));
	}

	public static function family2id( $family ) {
		return str_replace( ' ', '+', $family );
	}

	public static function id2family( $id ) {
		return str_replace( '+', ' ', $id );
	}
}