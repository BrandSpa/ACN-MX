<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Walker Class
 */
if( ! class_exists( 'Hydrogen_Walker_Nav_Menu' ) ):

	if( class_exists( 'Youxi_One_Pager_Nav_Walker' ) ) {
		class Hydrogen_WNMP extends Youxi_One_Pager_Nav_Walker {}
	} else {
		class Hydrogen_WNMP extends Walker_Nav_Menu {}
	}

	class Hydrogen_Walker_Nav_Menu extends Hydrogen_WNMP {

		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

			if( $element ) {
				$id_field = $this->db_fields['id'];

				if( isset( $args[0] ) && is_object( $args[0] ) ) {
					$args[0]->link_after = empty( $children_elements[ $element->$id_field ] ) ? '' : '<span class="sub-toggle"></span>';
				}
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
endif;

/**
 * Filter Footer Social Icon Choices
 */
if( ! function_exists( 'hydrogen_ot_type_select_choices_footer_social_icons_icon' ) ):

function hydrogen_ot_type_select_choices_footer_social_icons_icon( $field_choices, $field_id ) {

	if( preg_match( '/^footer_social_icons_icon_\d+$/', $field_id ) ) {
		$field_choices = array();
		foreach( (array) hydrogen_socicon_choices() as $value => $label ) {
			$label = ucfirst( $label );
			$field_choices[] = compact( 'value', 'label' );
		}
	}
	return $field_choices;
}
endif;
add_filter( 'ot_type_select_choices', 'hydrogen_ot_type_select_choices_footer_social_icons_icon', 10, 2 );

/**
 * Filter Custom Styles
 */
if( ! function_exists( 'hydrogen_ot_type_select_choices_custom_styles' ) ):

function hydrogen_ot_type_select_choices_custom_styles( $field_choices, $field_id ) {

	if( preg_match( '/^(preloader|header|blog|page|portfolio)_style$/', $field_id ) ) {
		$styles = Youxi_Styles_Manager::get()->get_styles_list();
		foreach( $styles as $value => $label ) {
			$field_choices[] = compact( 'value', 'label' );
		}
	}
	return $field_choices;
}
endif;
add_filter( 'ot_type_select_choices', 'hydrogen_ot_type_select_choices_custom_styles', 10, 2 );

/**
 * Function to determine the first access of a page block.
 * Used for rendering page block title.
 */
if( ! function_exists( 'hydrogen_is_page_block_first_access' ) ):

function hydrogen_is_page_block_first_access() {
	global $post;

	static $last_post;

	if( is_a( $post, 'WP_Post' ) && Youxi_One_Pager::post_type_name() == $post->post_type ) {
		if( ! is_a( $last_post, 'WP_Post' ) || $last_post->ID != $post->ID ) {
			$last_post = $post;
			return true;
		}
	}

	return false;
}
endif;

/**
 * Helper method to quickly retrieve array value specified by $key
 */
if( ! function_exists( 'hydrogen_arr_get' ) ):

function hydrogen_arr_get( $array, $key, $default = '' ) {
	return is_array( $array ) && isset(  $array[ $key ] ) ? $array[ $key ] : $default;
}
endif;

/**
 * Returns the default accent color. @brand-primary on Bootstrap.
 */
function hydrogen_default_accent_color() {
	return apply_filters( 'hydrogen_default_accent_color', '#ec005f' );
}

/**
 * Preprocess style manager LESS variables
 */
function hydrogen_style_manager_less_vars( $styles ) {

	/* Get the accent color setting */
	$brand_primary = ot_get_option( 'accent_color', hydrogen_default_accent_color() );
	
	foreach( $styles as $name => $vars ) {
		$styles[ $name ] = array_merge(
			$vars, 
			array(
				'brand-primary' => $brand_primary, 
				'style-name' => "e('$name')"
			)
		);
	}

	return $styles;
}
add_filter( 'youxi_styles_manager_less_vars', 'hydrogen_style_manager_less_vars' );

/**
 * Returns available aspect ratios to use on Bootstrap Responsive Embeds.
 */
function hydrogen_available_aspect_ratios() {
	return apply_filters( 'hydrogen_available_aspect_ratios', array( array( 16, 9 ), array( 4, 3 ) ) );
}

/**
 * Function to determine the correct Bootstrap Responsive Embed class.
 */
function hydrogen_closest_aspect_ratio( $width, $height, $default = array( 16, 9 ) ) {

	/* Prevents division by zero */
	if( 0 == $height ) {
		return $default;
	}

	$target_ratio = floatval( $width / $height );
	$closest_ratio = $default;

	foreach( hydrogen_available_aspect_ratios() as $aspect_ratio ) {
		if( ! isset( $aspect_ratio[0] ) || ! isset( $aspect_ratio[1] ) || 0 == $aspect_ratio[1] ) {
			continue;
		}
		$difference = abs( 1.0 - ( $target_ratio / floatval( $aspect_ratio[0] / $aspect_ratio[1] ) ) );
		if( ! isset( $min_difference ) || $min_difference > $difference ) {
			$min_difference = $difference;
			$closest_ratio = $aspect_ratio;
		}
	}

	return $closest_ratio;
}

/**
 * Return this theme's valid CSS Animation names
 */
if( ! function_exists( 'hydrogen_trigger_attachments_caching' ) ):

function hydrogen_trigger_attachments_caching( $attachments ) {
	if( ! is_array( $attachments ) || empty( $attachments ) ) {
		return;
	}
	get_posts(array(
		'post_type' => 'attachment', 
		'posts_per_page' => -1, 
		'post__in' => $attachments
	));
}
endif;

/**
 * Return this theme's valid CSS Animation names
 */
if( ! function_exists( 'hydrogen_animation_names' ) ):

function hydrogen_animation_names( $names ) {
	return array_merge( $names, array(
		'flipInX', 
		'flipInY', 
		'fadeInUp', 
		'fadeInDown', 
		'fadeInLeft', 
		'fadeInRight', 
		'fadeInUpBig', 
		'fadeInDownBig', 
		'fadeInLeftBig', 
		'fadeInRightBig', 
		'slideInDown', 
		'slideInLeft', 
		'slideInRight', 
		'bounceIn', 
		'bounceInUp', 
		'bounceInDown', 
		'bounceInLeft', 
		'bounceInRight', 
		'rotateIn', 
		'rotateInUpLeft', 
		'rotateInDownLeft', 
		'rotateInUpRight', 
		'rotateInDownRight'
	));
}
endif;

/**
 * Twitter ajax method
 */
if( ! function_exists( 'hydrogen_get_tweets' ) ):

function hydrogen_get_tweets() {

	if( ! class_exists( 'YTwitterOAuth' ) ) {
		require( get_template_directory() . '/lib/class-twitter-oauth.php' );
	}

	if( isset( $_POST['request'] ) ) {

		$request = $_POST['request'];

		if( isset( $request['host'], $request['url'], $request['parameters'] ) ) {

			// Initialize Twitter Feeds Manager
			$keys = apply_filters( 'youxi_widgets_twitter_keys', array(
				'consumer_key' => '', 
				'consumer_secret' => '', 
				'oauth_token' => '', 
				'oauth_token_secret' => ''
			));

			extract( $keys, EXTR_SKIP );

			$twitter = new YTwitterOAuth( $consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret );
			$tweets = $twitter->fetch( $request['host'], $request['url'], 'GET', $request['parameters'] );

			$response = array( 'response' => null, 'message' => null );
			
			if( $tweets ) {
				$response['response'] = $tweets;
			} else {
				$response['message'] = $twitter->get_debug_info();
			}

			wp_send_json( $response );
		}
	}

	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		wp_die();
	} else {
		die;
	}
}
endif;

if( ! has_action( 'wp_ajax_youxi_get_tweets' ) ) {
	add_action( 'wp_ajax_youxi_get_tweets', 'hydrogen_get_tweets' );
}
if( ! has_action( 'wp_ajax_nopriv_youxi_get_tweets' ) ) {
	add_action( 'wp_ajax_nopriv_youxi_get_tweets', 'hydrogen_get_tweets' );
}

/**
 * Get sidebars as an associative array
 */
if( ! function_exists( 'hydrogen_available_widget_areas' ) ):

function hydrogen_available_widget_areas() {
    global $wp_registered_sidebars;
    return apply_filters( 'hydrogen_available_widget_areas', wp_list_pluck( $wp_registered_sidebars, 'name' ) );
}
endif;

/**
 * Helper function to replace underscores
 */
function hydrogen_replace_underscores( $str, $replace = '-' ) {
	return str_replace( '_', $replace, $str );
}

if( ! function_exists( 'hydrogen_link_pages_link' ) ):

function hydrogen_link_pages_link( $link ) {
	return '<li>' . $link . '</li>';
}
endif;
add_filter( 'wp_link_pages_link', 'hydrogen_link_pages_link' );