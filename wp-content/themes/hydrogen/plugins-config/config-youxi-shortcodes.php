<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_SHORTCODE_VERSION' ) ) {
	return;
}

/* ==========================================================================
	Youxi Shortcode plugin config
============================================================================= */

/**
 * Disable enqueueing the default assets
 */
add_filter( 'youxi_shortcode_enqueue_assets', '__return_false' );

/**
 * Disable shortcode prefixes (Youxi Shortcode 3.1+)
 */
add_filter( 'youxi_shortcode_prefix', '__return_empty_string' );

/**
 * Hook to modify some shortcodes
 */
if( ! function_exists( 'hydrogen_youxi_shortcode_register' ) ) {

	function hydrogen_youxi_shortcode_register( $manager ) {

		// Remove pricing tables shortcode
		$ptables = $manager->remove_shortcode( 'pricing_tables' );
	}
}
add_action( 'youxi_shortcode_register', 'hydrogen_youxi_shortcode_register' );

/**
 * Add the tinymce and page builder to `post`
 */
if( ! function_exists( 'hydrogen_shortcode_tinymce_post_types' ) ) {

	function hydrogen_shortcode_tinymce_post_types( $post_types ) {
		
		if( ! is_array( $post_types ) ) {
			$post_types = array( $post_types );
		}
		$post_types[] = 'post';

		return $post_types;
	}
}
add_filter( 'youxi_shortcode_tinymce_post_types', 'hydrogen_shortcode_tinymce_post_types' );

/* ==========================================================================
	Shortcode Animation
============================================================================= */

/**
 * Enable shortcode animation
 */
add_filter( 'youxi_shortcode_enable_animation', '__return_true' );

/* Filter shortcode animation names */
add_filter( 'youxi_shortcode_animation_names', 'hydrogen_animation_names' );

/**
 * Filter shortcode animation targets
 */
if( ! function_exists( 'hydrogen_shortcode_animation_targets' ) ):

function hydrogen_shortcode_animation_targets( $targets ) {

	/* Define the animatable shortcodes */
	return array_merge( $targets, array(
		'accordion' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'alert' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'call_to_action' => array(
			'self'   => __( 'Self', 'youxi' ), 
			'text'   => __( 'Text', 'youxi' ), 
			'button' => __( 'Button', 'youxi' ), 
		), 
		'clients' => array(
			'items' => __( 'Items', 'youxi' )
		), 
		'counter' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'embed' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'icon_box' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'portfolio' => array(
			'items' => __( 'Items', 'youxi' )
		), 
		'posts' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'pricing_table' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'service' => array(
			'self'        => __( 'Self', 'youxi' ), 
			'icon'        => __( 'Icon', 'youxi' ), 
			'shadow-icon' => __( 'Shadow Icon', 'youxi' ), 
			'text'        => __( 'Text', 'youxi' )
		), 
		'table' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'tabs' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'team' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'testimonials' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'text_widget' => array(
			'self' => __( 'Self', 'youxi' )
		), 
		'twitter' => array(
			'self' => __( 'Self', 'youxi' )
		)
	));
}
endif;
add_filter( 'youxi_shortcode_animation_targets', 'hydrogen_shortcode_animation_targets', 9 );

/* ==========================================================================
	Accordion
============================================================================= */

/**
 * Accordion shortcode callback
 */
if( ! function_exists( 'hydrogen_accordion_shortcode_cb' ) ):

	function hydrogen_accordion_shortcode_cb( $atts, $content, $tag ) {

		/* Store accordion behavior */
		$accordion_id = $tag . '-' . Youxi_Shortcode::read_counter( $tag );
		$GLOBALS[ $accordion_id . '-behavior' ] = $atts['behavior'];

		$o = '<div class="panel-group" id="' . esc_attr( $accordion_id ) . '"' . hydrogen_arr_get( $atts['animate'], 'self' ) . '>';
			$o .= do_shortcode( $content );
		$o .= '</div>';

		/* Remove accordion behavior */
		unset( $GLOBALS[ $accordion_id . '-behavior' ] );

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_accordion_callback', create_function( '', 'return "hydrogen_accordion_shortcode_cb";' ) );

/* ==========================================================================
	Alert
============================================================================= */

/**
 * Alert shortcode callback
 */
if( ! function_exists( 'hydrogen_alert_shortcode_cb' ) ):

	function hydrogen_alert_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$classes = array( 'alert' );
		if( ! empty( $type ) ) {
			$classes[] = "alert-{$type}";
		}
		
		$o = '<div class="' . join( ' ', $classes ) . '"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			$o .= '<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>';

			if( $title ):
			$o .= '<h4>' . $title . '</h4>';
			endif;

			$o .= wp_kses_post( $content );

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_alert_callback', create_function( '', 'return "hydrogen_alert_shortcode_cb";' ) );

/* ==========================================================================
	Call to Action
============================================================================= */

/**
 * Call to Action shortcode atts
 */
if( ! function_exists( 'hydrogen_call_to_action_shortcode_atts' ) ):

	function hydrogen_call_to_action_shortcode_atts( $atts ) {
		
		$p1 = array_slice( $atts, 0, 1 );
		$p2 = array_slice( $atts, 1 );
		$pn = array(
			'title_tag' => array(
				'type' => 'select', 
				'label' => __( 'Title Element', 'youxi' ), 
				'description' => __( 'Choose the HTML element to use for the title.', 'youxi' ), 
				'choices' => array(
					'h1' => 'H1', 
					'h2' => 'H2', 
					'h3' => 'H3', 
					'h4' => 'H4', 
					'h5' => 'H5', 
					'h6' => 'H6'
				), 
				'std' => 'h1'
			), 
			'inline' => array(
				'type' => 'switch', 
				'label' => __( 'Inline', 'youxi' ), 
				'description' => __( 'Switch to Display Text and Button in One Row', 'youxi' ), 
				'std' => true
			), 
			'unboxed' => array(
				'type' => 'switch', 
				'label' => __( 'Unboxed', 'youxi' ), 
				'description' => __( 'Switch to Remove Borders and Paddings', 'youxi' ), 
				'std' => false
			)
		);

		return array_merge( $p1, $pn, $p2 );
	}
endif;
add_filter( 'youxi_shortcode_call_to_action_atts', 'hydrogen_call_to_action_shortcode_atts' );

/**
 * Call to Action shortcode callback
 */
if( ! function_exists( 'hydrogen_call_to_action_shortcode_cb' ) ):

	function hydrogen_call_to_action_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		/* Compile button classes */
		$btn_classes = array( 'btn' );
		if( $btn_size ) {
			$btn_classes[] = sanitize_html_class( 'btn-' . $btn_size );
		}
		if( $btn_type ) {
			$btn_classes[] = sanitize_html_class( 'btn-' . $btn_type );
		}

		switch( $btn_action ) {
			case 'page':
				$url = get_permalink( $post_id );
				$url = $url ? $url : '#';
				break;
		}

		/* Compile wrapper classes */
		$wrapper_classes = array( 'call-to-action' );
		if( $inline ) {
			$wrapper_classes[] = sanitize_html_class( 'one-row' );
		}
		if( $unboxed ) {
			$wrapper_classes[] = sanitize_html_class( 'unboxed' );
		}

		/* Validate heading tag */
		if( ! preg_match( '/^h[1-6]$/', $title_tag ) ) {
			$title_tag = 'h1';
		}

		/* Construct HTML */
		$o = '<div class="' . esc_attr( join( ' ', $wrapper_classes ) ) . '"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			$o .= '<div class="call-to-action-inner">';

				$o .= '<div class="col-text"' . hydrogen_arr_get( $animate, 'text' ) . '>';

					$o .= '<' . $title_tag . ' class="headline">' . $title . '</' . $title_tag . '>';
					$o .= wpautop( wp_kses_post( $content ) );

				$o .= '</div>';

				$o .= '<div class="col-btn"' . hydrogen_arr_get( $animate, 'button' ) . '>';

					$o .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( join( ' ', $btn_classes ) ) . '">';
						$o .= $btn_text;
					$o .= '</a>';

				$o .= '</div>';

			$o .= '</div>';

		$o .= '</div>';
		
		return $o;
	}
endif;
add_filter( 'youxi_shortcode_call_to_action_callback', create_function( '', 'return "hydrogen_call_to_action_shortcode_cb";' ) );

/* ==========================================================================
	Clients
============================================================================= */

/**
 * Clients shortcode callback
 */
if( ! function_exists( 'hydrogen_clients_shortcode_cb' ) ):

	function hydrogen_clients_shortcode_cb( $atts, $content, $tag ) {

		/* Store the item animations global variable */
		$clients_id = Youxi_Shortcode::uniqid( $tag );
		$GLOBALS[ $clients_id . '-animate' ] = hydrogen_arr_get( $atts, 'animate', array() );

		$output = '<div class="client-list"><ul>' . do_shortcode( $content ) . '</ul></div>';

		/* Remove the item animations global variable */
		unset( $GLOBALS[ $clients_id . '-animate' ] );

		return $output;
	}
endif;
add_filter( 'youxi_shortcode_clients_callback', create_function( '', 'return "hydrogen_clients_shortcode_cb";' ) );

/**
 * Client shortcode callback
 */
if( ! function_exists( 'hydrogen_client_shortcode_cb' ) ):

	function hydrogen_client_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		/* Retrieve the item animations global variable */
		$parent_id = Youxi_Shortcode::uniqid( 'clients' );
		$animate  = hydrogen_arr_get( $GLOBALS, $parent_id . '-animate', array() );
		
		$o = '<li class="client"' . hydrogen_arr_get( $animate, 'items' ) . '>';

			$o .= '<div class="client-logo">';

				$o .= '<div class="logo">';

					if( $url ):
					$o .= '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $name ) . '">';
						$o .= '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( $name ) . '">';
					$o .= '</a>';
					else:
					$o .= '<span>';
						$o .= '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( $name ) . '">';
					$o .= '</span>';
					endif;

				$o .= '</div>';

			$o .= '</div>';

		$o .= '</li>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_client_callback', create_function( '', 'return "hydrogen_client_shortcode_cb";' ) );

/* ==========================================================================
	Container
============================================================================= */

/**
 * Container shortcode callback
 */
if( ! function_exists( 'hydrogen_container_shortcode_cb' ) ):

	function hydrogen_container_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$classes = array( 'section-row' );

		if( 'full' != $padding_top ) {
			$classes[] = "{$padding_top}-padding-top";
		}
		if( 'full' != $padding_bottom ) {
			$classes[] = "{$padding_bottom}-padding-bottom";
		}
		if( $transparent_bg ) {
			$classes[] = 'bg-transparent';
		}
		if( $shadow_bg ) {
			$classes[] = 'shadow-bg';
		}
		if( isset( $style ) && ! empty( $style ) ) {
			$classes[] = "style-{$style}";
		}

		$html = ' class="' . join( ' ', $classes ) . '"';
		if( $background ) {
			$html .= ' style="background-image: url(' . esc_url( $background ) . ')"';
		}

		$o = '<div' . $html . '>';

			$o .= '<div class="container">';

				$o .= apply_filters( 'hydrogen_container_shortcode_content', do_shortcode( $content ) );

			$o .= '</div>';

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_container_callback', create_function( '', 'return "hydrogen_container_shortcode_cb";' ) );

/**
 * Container shortcode atts
 */
if( ! function_exists( 'hydrogen_container_shortcode_atts' ) ):

	function hydrogen_container_shortcode_atts( $atts ) {

		if( class_exists( 'Youxi_Styles_Manager' ) ) {
			$atts = array_merge( $atts, array(
				'style' => array(
					'type' => 'select', 
					'label' => __( 'Container Style', 'youxi' ), 
					'description' => __( 'Choose here a custom style for the contents of this container.', 'youxi' ), 
					'choices' => array( Youxi_Styles_Manager::get(), 'get_styles_list' ), 
					'std' => 0
				)
			));
		}

		return array_merge( $atts, array(
			'transparent_bg' => array(
				'type' => 'switch', 
				'label' => __( 'Transparent Background', 'youxi' ), 
				'description' => __( 'Switch to make the container background transparent.', 'youxi' ), 
				'std' => false
			), 
			'shadow_bg' => array(
				'type' => 'switch', 
				'label' => __( 'Shadow Background', 'youxi' ), 
				'description' => __( 'Switch to make the container have a slightly shaded background.', 'youxi' ), 
				'std' => false, 
				'criteria' => 'transparent_bg:is(0)'
			), 
			'padding_top' => array(
				'type' => 'select', 
				'label' => __( 'Padding Top', 'youxi' ), 
				'description' => __( 'Choose the container\'s top padding size.', 'youxi' ), 
				'std' => 'full', 
				'choices' => array(
					'no' => __( 'None', 'youxi' ), 
					'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
					'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
					'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
					'full' => __( 'Full (140px at Maximum)', 'youxi' )
				)
			), 
			'padding_bottom' => array(
				'type' => 'select', 
				'label' => __( 'Padding Bottom', 'youxi' ), 
				'description' => __( 'Choose the container\'s bottom padding size.', 'youxi' ), 
				'std' => 'full', 
				'choices' => array(
					'no' => __( 'None', 'youxi' ), 
					'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
					'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
					'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
					'full' => __( 'Full (140px at Maximum)', 'youxi' )
				)
			), 
			'background' => array(
				'type' => 'image', 
				'label' => __( 'Image', 'youxi' ), 
				'description' => __( 'Choose an image as the container\'s background.', 'youxi' ), 
				'std' => '', 
				'return_type' => 'url', 
				'frame_title' => __( 'Choose an Image', 'youxi' ), 
				'frame_btn_text' => __( 'Insert URL', 'youxi' ), 
				'upload_btn_text' => __( 'Choose an Image', 'youxi' )
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_container_atts', 'hydrogen_container_shortcode_atts' );

if( ! function_exists( 'hydrogen_shortcode_column_sizes' ) ):

function hydrogen_shortcode_column_sizes( $sizes ) {
	return range( 2, 12 );
}
endif;
add_filter( 'youxi_shortcode_column_sizes', 'hydrogen_shortcode_column_sizes' );

/* ==========================================================================
	Counter
============================================================================= */

/**
 * Counter shortcode callback
 */
if( ! function_exists( 'hydrogen_counter_shortcode_cb' ) ):

	function hydrogen_counter_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$attributes = array(
			'class' => 'counter', 
			'data-duration' => $duration, 
			'data-decimals' => $decimals, 
			'data-opt-separator' => $thousands_separator, 
			'data-opt-decimal' => $decimal_separator
		);

		$html = '';
		foreach( $attributes as $key => $val ) {
			$html .= " {$key}=\"" . esc_attr( $val ) . '"';
		}

		$o = '<div' . $html . hydrogen_arr_get( $animate, 'self' ) . '>';
			$o .= '<span class="number">' . strip_tags( $content ) . '</span>';
			$o .= '<span class="label">' . $label . '</span>';
		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_counter_callback', create_function( '', 'return "hydrogen_counter_shortcode_cb";' ) );

/**
 * Counter shortcode atts
 */
if( ! function_exists( 'hydrogen_counter_shortcode_atts' ) ):

	function hydrogen_counter_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'duration' => array(
				'type' => 'uislider', 
				'label' => __( 'Duration', 'youxi' ), 
				'description' => __( 'Specify the counter animation duration.', 'youxi' ), 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 5, 
					'step' => 0.1
				), 
				'std' => 2
			), 
			'thousands_separator' => array(
				'type' => 'text', 
				'label' => __( 'Thousands Separator', 'youxi' ), 
				'description' => __( 'Enter here the thousands separator.', 'youxi' ), 
				'std' => ','
			), 
			'decimal_separator' => array(
				'type' => 'text', 
				'label' => __( 'Decimal Separator', 'youxi' ), 
				'description' => __( 'Enter here the decimal separator.', 'youxi' ), 
				'std' => '.'
			), 
			'decimals' => array(
				'type' => 'uislider', 
				'label' => __( 'Decimals', 'youxi' ), 
				'description' => __( 'Specify the number of decimal places.', 'youxi' ), 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 6, 
					'step' => 1
				), 
				'std' => 0
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_counter_atts', 'hydrogen_counter_shortcode_atts' );

/* ==========================================================================
	WordPress Embeds
============================================================================= */

/**
 * Filter WordPress embed result
 */
function hydrogen_embed_html_callback( $html, $url, $atts ) {

	$animation_html = '';

	/* Attach animations if shortcode plugin is active */
	if( isset( $atts['animate'] ) ) {
		/* Parse Animations */
		$atts = Youxi_Shortcode_Animation::get()->parse( $atts, 'embed' );
		$animation_html = hydrogen_arr_get( $atts['animate'], 'self' );
	}

	$is_video = false;
	$aspect_ratio = array( 16, 9 );
	$classes = array( 'media' );

	// Get the oEmbed data
	$data = hydrogen_get_oembed_cache( $url );

	// Check from the oEmbed data if the URL is a video
	if( is_object( $data ) && ! empty( $data->type ) && ( $is_video = ( 'video' == $data->type ) ) ) {

		if( is_numeric( $data->width ) && is_numeric( $data->height ) ) {
			$aspect_ratio = hydrogen_closest_aspect_ratio( $data->width, $data->height, $aspect_ratio );
		}
	}

	// Worst case, use regex to determine if it's a YouTube/Vimeo video
	else {
		$yt_pattern = '#^https?://(www\.)?(youtube\.com/watch|youtu\.be/).*#i';
		$vm_pattern = '#^https?://(.+\.)?vimeo\.com/.*#i';

		$is_video = preg_match( $yt_pattern, $url ) || preg_match( $vm_pattern, $url );
	}

	if( $is_video ) {
		$classes[] = 'embed-responsive';
		$classes[] = 'embed-responsive-' . implode( 'by', $aspect_ratio );
	}

	return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '"' . $animation_html . '>' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'hydrogen_embed_html_callback', 10, 3 );
add_filter( 'embed_handler_html', 'hydrogen_embed_html_callback', 10, 3 );

/* ==========================================================================
	Widget Area
============================================================================= */

/**
 * Widget area shortcode output filter
 */
if( ! function_exists( 'hydrogen_widget_area_shortcode_output' ) ):

	function hydrogen_widget_area_shortcode_output( $html ) {
		return '<aside class="sidebar">' . $html . '</aside>';
	}
endif;
add_filter( 'youxi_shortcode_widget_area_output', 'hydrogen_widget_area_shortcode_output' );

/* ==========================================================================
	Fullwidth
============================================================================= */

/**
 * Fullwidth shortcode output filter
 */
if( ! function_exists( 'hydrogen_fullwidth_shortcode_output' ) ):

	function hydrogen_fullwidth_shortcode_output( $html ) {
		return '<div class="section-row no-padding-top no-padding-bottom">' . $html . '</div>';
	}
endif;
add_filter( 'youxi_shortcode_fullwidth_output', 'hydrogen_fullwidth_shortcode_output' );

/* ==========================================================================
	Google Map
============================================================================= */

/**
 * Google Map shortcode atts
 */
if( ! function_exists( 'hydrogen_google_map_shortcode_atts' ) ):

	function hydrogen_google_map_shortcode_atts( $atts ) {

		if( isset( $atts['aspect_ratio'] ) ) {
			$atts['aspect_ratio']['criteria'] = 'auto_aspect_ratio:is(0)';
		}

		$ar_index = array_search( 'aspect_ratio', array_keys( $atts ) );
		$p1 = array_slice( $atts, 0, $ar_index );
		$p2 = array_slice( $atts, $ar_index );
		$pn = array(
			'auto_aspect_ratio' => array(
				'type' => 'switch', 
				'label' => __( 'Auto Aspect Ratio', 'youxi' ), 
				'description' => __( 'Switch whether to control the Google Map aspect ratio automatically.', 'youxi' ), 
				'std' => true
			)
		);

		return array_merge( $p1, $pn, $p2 );
	}
endif;
add_filter( 'youxi_shortcode_google_map_atts', 'hydrogen_google_map_shortcode_atts' );

/**
 * Google Map shortcode callback
 */
if( ! function_exists( 'hydrogen_google_map_shortcode_cb' ) ):

	function hydrogen_google_map_shortcode_cb( $atts, $content, $tag ) {

		preg_match_all( '/\((.+?),(.+?)\)/', $atts['markers'], $markers, PREG_SET_ORDER );

		foreach( $markers as $key => $marker ) {
			$markers[ $key ] = array(
				'lat' => isset( $marker[1] ) ? $marker[1] : 0.0, 
				'lng' => isset( $marker[2] ) ? $marker[2] : 0.0, 
			);
		}

		$gmap_style = '';
		if( ! $atts['auto_aspect_ratio'] && is_string( $atts['aspect_ratio'] ) ) {
			$ar = explode( ':', $atts['aspect_ratio'] );
			if( isset( $ar[0], $ar[1] ) ) {
				$pad = 100 * max( 1, intval( $ar[1] ) ) / max( 1, intval( $ar[0] ) );
			} else {
				$pad = 100 * floatval( 9 / 16 );
			}
			$gmap_style = ' style="padding-bottom: ' . $pad . '%"';
		}

		if( is_string( $atts['controls'] ) ) {
			$controls = array();
			foreach( explode( ',', $atts['controls'] ) as $control ) {
				$controls[ $control ] = 1;
			}
		} elseif( is_array( $atts['controls'] ) ) {
			$controls = $atts['controls'];
		} else {
			$controls = array();
		}

		$controls = shortcode_atts( array(
			'pan' => false, 
			'zoom' => false, 
			'map-type' => false, 
			'scale' => false, 
			'street-view' => false, 
			'overview-map' => false
		), $controls );

		$attributes = array();
		$attributes['data-widget']      = 'gmap';
		$attributes['data-scrollwheel'] = $atts['scrollwheel'];
		$attributes['data-center']      = implode( ',', array( $atts['center_lat'], $atts['center_lng'] ) );
		$attributes['data-map-type-id'] = $atts['map_type'];
		$attributes['data-monochrome']  = json_encode( (bool) $atts['monochrome'] );
		$attributes['data-markers']     = json_encode( (array) $markers );
		$attributes['data-zoom']        = intval( $atts['zoom'] );

		foreach( $controls as $id => $control ) {
			$attributes['data-' . $id . '-control'] = json_encode( $control );
		}

		$html = '';
		foreach( $attributes as $key => $val ) {
			$html .= " {$key}=\"" . esc_attr( $val ) . "\"";
		}

		return '<div class="google-maps-container"' . $gmap_style . '><div class="google-maps"' . $html . '></div></div>';
	}
endif;
add_filter( 'youxi_shortcode_google_map_callback', create_function( '', 'return "hydrogen_google_map_shortcode_cb";' ) );

/* ==========================================================================
	Heading
============================================================================= */

/**
 * Heading shortcode callback
 */
if( ! function_exists( 'hydrogen_heading_shortcode_cb' ) ):

	function hydrogen_heading_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$content = strip_tags( $content );
		$classes = '';

		if( $style ) {
			switch( $style ) {
				case 'separator':
					$classes .= 'section-separator-title';
					if( $shadow_text ) {
						$content = '<span data-shadow-text="' . esc_attr( $shadow_text ) . '">' . $content . '</span>';
					}
					break;
				case 'alt':
					$classes .= 'alt-style';
					break;
			}
		}

		if( in_array( $alignment, array( 'center', 'right' ) ) ) {
			$classes .= ' text-' . $alignment;
		}

		if( $uppercase ) {
			$classes .= ' text-uppercase';
		}

		if( is_string( $remove_margins ) ) {
			$remove_margins = array_unique( array_map( 'trim', explode( ',', $remove_margins ) ) );
			foreach( $remove_margins as $remove ) {
				if( preg_match( '/^(top|bottom)$/', $remove ) ) {
					$classes .= ' no-margin-' . $remove;
				}
			}
		}

		$classes .= ' ' . sanitize_html_class( trim( $extra_classes ) );

		if( $classes ) {
			$classes = ' class="' . esc_attr( trim( $classes ) ) . '"';
		} else {
			$classes = '';
		}

		return '<' . $element . $classes . '>' . $content . '</' . $element . '>';
	}
endif;
add_filter( 'youxi_shortcode_heading_callback', create_function( '', 'return "hydrogen_heading_shortcode_cb";' ) );

/**
 * Heading shortcode atts
 */
if( ! function_exists( 'hydrogen_heading_shortcode_atts' ) ):

	function hydrogen_heading_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'alignment' => array(
				'type' => 'radio', 
				'label' => __( 'Heading Alignment', 'youxi' ), 
				'description' => __( 'Choose here the heading text alignment.', 'youxi' ), 
				'choices' => array(
					'left' => __( 'Left', 'youxi' ), 
					'center' => __( 'Center', 'youxi' ), 
					'right' => __( 'Right', 'youxi' )
				), 
				'std' => 'left', 
				'fieldset' => 'style'
			), 
			'style' => array(
				'type' => 'radio', 
				'label' => __( 'Heading Style', 'youxi' ), 
				'description' => __( 'Choose the heading style.', 'youxi' ), 
				'choices' => array(
					0 => __( 'Default', 'youxi' ), 
					'alt' => __( 'Alternate', 'youxi' ), 
					'separator' => __( 'Separator', 'youxi' )
				), 
				'std' => 0
			), 
			'uppercase' => array(
				'type' => 'switch', 
				'label' => __( 'Uppercase Letters', 'youxi' ), 
				'description' => __( 'Switch to make the text uppercase.', 'youxi' ), 
				'std' => false, 
				'fieldset' => 'style'
			), 
			'remove_margins' => array(
				'type' => 'checkboxlist', 
				'label' => __( 'Remove Margins', 'youxi' ), 
				'uncheckable' => true, 
				'description' => __( 'Choose here which margins to remove from the heading.', 'youxi' ), 
				'choices' => array(
					'top' => __( 'Top', 'youxi' ), 
					'bottom' => __( 'Bottom', 'youxi' ), 
				), 
				'serialize' => 'js:function( data ) {
					return $.map( data, function( data, key ) {
						if( !! parseInt( data ) )
							return key;
					});
				}', 
				'deserialize' => 'js:function( data ) {
					var temp = {};
					_.each( ( data + "" ).split( "," ), function( c ) {
						temp[ c ] = 1;
					});
					return temp;
				}', 
				'fieldset' => 'style'
			), 
			'extra_classes' => array(
				'type' => 'text', 
				'label' => __( 'Extra CSS Classes', 'youxi' ), 
				'description' => __( 'Enter here your custom CSS classes to apply to the heading.', 'youxi' ), 
				'std' => '', 
				'fieldset' => 'style'
			), 
			'shadow_text' => array(
				'type' => 'text', 
				'label' => __( 'Separator Shadow Text', 'youxi' ), 
				'description' => __( 'Enter here the shadow text to display behind the separator title.', 'youxi' ), 
				'std' => '', 
				'criteria' => 'style:is(separator)'
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_heading_atts', 'hydrogen_heading_shortcode_atts' );

/**
 * Heading shortcode fieldsets
 */
if( ! function_exists( 'hydrogen_heading_shortcode_fieldsets' ) ):

function hydrogen_heading_shortcode_fieldsets( $fieldsets ) {
	return array_merge( $fieldsets, array(
		'style' => array(
			'id' => 'style', 
			'title' => __( 'Styling', 'youxi' )
		)
	));
}
endif;
add_filter( 'youxi_shortcode_heading_fieldsets', 'hydrogen_heading_shortcode_fieldsets' );

/* ==========================================================================
	Icon Box
============================================================================= */

/**
 * Icon Box shortcode callback
 */
if( ! function_exists( 'hydrogen_icon_box_shortcode_cb' ) ):

	function hydrogen_icon_box_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$extra_classes = '';
		if( 'horizontal' != $layout ) {
			$extra_classes .= " {$layout}";
		}
		if( 'default' != $icon_layout ) {
			$extra_classes .= " {$icon_layout}";
		}

		$o = '<div class="icon-box' . $extra_classes . '"' . hydrogen_arr_get( $animate, 'self' ) . '>';
			$o .= '<div class="icon">';
				$o .= '<i class="' . esc_attr( $icon ) . '"></i>';
			$o .= '</div>';
			$o .= '<div class="info">';
				$o .= '<h4>' . $title . '</h4>';
				$o .= wpautop( wp_kses_post( $content ) );
			$o .= '</div>';
		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_icon_box_callback', create_function( '', 'return "hydrogen_icon_box_shortcode_cb";' ) );

/**
 * Icon Box shortcode atts
 */
if( ! function_exists( 'hydrogen_icon_box_shortcode_atts' ) ):

	function hydrogen_icon_box_shortcode_atts( $atts ) {

		$atts['icon'] = array_merge( $atts['icon'], array(
			'assets' => array(
				get_template_directory_uri() . '/assets/icons/style.css', 
			), 
			'choices' => array( 
				'glyphicons' => array(
					'icons' => hydrogen_glyphicons_choices(), 
					'label' => __( 'Glyphicons', 'youxi' )
				), 
				'font-awesome' => array(
					'icons' => hydrogen_fontawesome_choices(), 
					'label' => __( 'Font Awesome', 'youxi' )
				), 
				'socicon' => array(
					'icons' => hydrogen_socicon_choices(), 
					'label' => __( 'Socicon', 'youxi' )
				)
			)
		));

		return array_merge( $atts, array(
			'layout' => array(
				'type' => 'select', 
				'label' => __( 'Layout', 'youxi' ), 
				'description' => __( 'Choose the icon box\'s layout.', 'youxi' ), 
				'std' => 'horizontal', 
				'choices' => array(
					'horizontal' => __( 'Horizontal (Default)', 'youxi' ), 
					'vertical' => __( 'Vertical', 'youxi' )
				)
			), 
			'icon_layout' => array(
				'type' => 'select', 
				'label' => __( 'Icon Layout', 'youxi' ), 
				'description' => __( 'Choose the icon box\'s icon layout.', 'youxi' ), 
				'std' => 'default', 
				'choices' => array(
					'default' => __( 'Default', 'youxi' ), 
					'circled' => __( 'Circled', 'youxi' ), 
					'boxed' => __( 'Boxed', 'youxi' )
				)
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_icon_box_atts', 'hydrogen_icon_box_shortcode_atts' );

/* ==========================================================================
	Posts
============================================================================= */

/**
 * Trigger Posts Shortcode Media Attachments Caching
 */
if( ! function_exists( 'hydrogen_posts_shortcode_cache_media_attachments' ) ):

function hydrogen_posts_shortcode_cache_media_attachments( $wp_query ) {

	if( ! is_a( $wp_query, 'WP_Query' ) ) {
		return;
	}

	$attachments = array();
	$wp_query->rewind_posts();

	while( $wp_query->have_posts() ): $wp_query->the_post();

		if( 'gallery' == get_post_format() ) {
			$meta = hydrogen_extract_post_format_meta();
			if( is_array( $meta ) && isset( $meta['images'] ) ) {
				$attachments = array_merge( $attachments, array_filter( (array) $meta['images'] ) );
			}
		} elseif( has_post_thumbnail() || 'image' == get_post_format() ) {
			$attachments[] = get_post_thumbnail_id();
		}

	endwhile;

	hydrogen_trigger_attachments_caching( $attachments );
}
endif;

/**
 * Posts Shortcode Media
 */
if( ! function_exists( 'hydrogen_posts_shortcode_media' ) ):

function hydrogen_posts_shortcode_media( $meta ) {

	$output = '';
	$post_format = get_post_format();
	if( $post_format && ! is_array( $meta ) ) {
		return '';
	}

	/* First retrieve any valid post format data */
	switch( $post_format ) {

		case 'audio':
			$output = '<div class="recent-post-media">';

				$output .= '<div class="media">';

				switch( $meta['type'] ) {
					case 'embed':
						global $wp_embed;
						if( is_a( $wp_embed, 'WP_Embed' ) ) {
							$output .= $wp_embed->autoembed( $meta['embed'] );
						} else {
							$output .= $meta['embed'];
						}
						break;
					case 'hosted':
						if( $__att_url = wp_get_attachment_url( $meta['src'] ) ) {
							$meta['src'] = $__att_url;
						}
						$output .= wp_audio_shortcode(array(
							'src' => $meta['src']
						));
						break;
					default:
						break;
				}

				$output .= '</div>';

			$output .= '</div>';
			break;
		case 'video':
			$output = '<div class="recent-post-media">';

			switch( $meta['type'] ) {
				case 'embed':
					$output .= '<div class="media embed-responsive embed-responsive-16by9">';
					global $wp_embed;
					if( is_a( $wp_embed, 'WP_Embed' ) ) {
						$output .= $wp_embed->autoembed( $meta['embed'] );
					} else {
						$output .= $meta['embed'];
					}
					$output .= '</div>';
					break;
				case 'hosted':
					if( $__att_url = wp_get_attachment_url( $meta['src'] ) ) {
						$meta['src'] = $__att_url;
					}
					if( $__att_url = wp_get_attachment_url( $meta['poster'] ) ) {
						$meta['poster'] = $__att_url;
					}
					$output .= '<div class="media">';
					$output .= wp_video_shortcode(array(
						'src' => $meta['src'], 
						'poster' => $meta['poster'], 
						'width' => '1920', 
						'height' => '1080'
					));
					$output .= '</div>';
				break;
			}

			$output .= '</div>';
			break;
		case 'gallery':
			$output = '<div class="recent-post-media standard-slider">';

				$output .= '<div class="royalSlider rsHydrogen">';

				foreach( array_filter( $meta['images'] ) as $image ) {

					if( $img_url = wp_get_attachment_image_src( $image, 'full' ) ) {

						$output .= '<div class="slider-media">';

							$output .= '<figure>';

								$output .= wp_get_attachment_image( $image, 'portfolio_16by9', false, array( 'class' => 'rsImg' ) );

							$output .= '</figure>';

							$output .= '<div class="overlay">';

								$output .= '<ul>';

									$output .= '<li class="mfp-zoom">';

										$output .= '<a href="' . esc_url( $img_url[0] ) . '">';

											$output .= '<i class="gi gi-resize-full"></i>';

										$output .= '</a>';

									$output .= '</li>';

								$output .= '</ul>';

							$output .= '</div>';

						$output .= '</div>';

					}

				}

				$output .= '</div>';

			$output .= '</div>';
			break;
		case 'quote':
			$output = '<blockquote>';

				$output .= wpautop( $meta['text'] );

				if( '' !== $meta['author'] ):

					$output .= '<small>';

					$output .= esc_html( $meta['author'] );

					if( '' !== $meta['source'] ):
						if( '' !== $meta['source_url'] ):

							$output .= '<a href="' . esc_url( $meta['source_url'] ) . '">';

								$output .= esc_html( $meta['source'] );

							$output .= '</a>';

						else:
							$output .= esc_html( $meta['source'] );
						endif;
					endif;

					$output .= '</small>';

				endif;

			$output .= '</blockquote>';
			$output = hydrogen_posts_shortcode_body( $output );
			break;
		case 'link':
		case 'aside':
			break;
		case 'image':
		default:
			if( has_post_thumbnail() ):

				$thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

				$output = '<div class="recent-post-media recent-post-img">';

					$output .= '<div class="media">';

						$output .= '<figure>';

							$output .= get_the_post_thumbnail( get_the_ID(), 'portfolio_16by9' );

						$output .= '</figure>';

						$output .= '<div class="overlay">';

							$output .= '<ul>';

								$output .= '<li class="mfp-zoom">';

									$output .= '<a href="' . esc_url( $thumbnail_url[0] ) . '">';

										$output .= '<i class="gi gi-resize-full"></i>';

									$output .= '</a>';

								$output .= '</li>';

							$output .= '</ul>';

						$output .= '</div>';

					$output .= '</div>';

				$output .= '</div>';
			endif;
			break;
	}

	return $output;
}
endif;

/**
 * Posts Shortcode Body
 */
if( ! function_exists( 'hydrogen_posts_shortcode_body' ) ):

function hydrogen_posts_shortcode_body( $override_body = '' ) {

	$output = '<div class="recent-post-body">';

		$output .= '<a href="' . esc_url( get_permalink() ) . '" class="read-more-link">';

			$output .= '<i class="gi gi-link"></i>';

		$output .= '</a>';

		$output .= '<div class="content">';

			if( '' !== $override_body ) {

				$output .= $override_body;

			} else {

				$output .= the_title( '<h4 class="post-title">', '</h4>', false );
				$output .= wpautop( get_the_excerpt() );
			}

			$output .= '<div class="meta">';

				$output .= '<ul>';

					$output .= '<li>' . esc_html( get_the_time( ot_get_option( 'blog_time_format' ) ) ) . '</li>';

					ob_start();
					comments_popup_link( __( 'no comments', 'youxi' ), __( '1 comment', 'youxi' ), __( '% comments', 'youxi' ) );

					$output .= '<li>' . ob_get_clean() . '</li>';

					// $output .= '<li><i class="gi gi-heart text-primary"></i> 22</li>';

				$output .= '</ul>';

			$output .= '</div>';

		$output .= '</div>';

	$output .= '</div>';

	return $output;
}
endif;

/**
 * Posts shortcode excerpt length
 */
if( ! function_exists( 'hydrogen_posts_shortcode_excerpt_length' ) ):

function hydrogen_posts_shortcode_excerpt_length( $length ) {
	return 20;
}
endif;

/**
 * Posts shortcode callback
 */
if( ! function_exists( 'hydrogen_posts_shortcode_cb' ) ):

	function hydrogen_posts_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		global $post;
		$tmp_post = $post;

		$output = '';
		$supported_post_formats = get_theme_support( 'post-formats' );
		if( is_array( $supported_post_formats ) && isset( $supported_post_formats[0] ) ) {
			$supported_post_formats = $supported_post_formats[0];
		}

		/* Make sure the category__not_in parameter is an array */
		if( is_string( $atts['category__not_in'] ) && '' !== trim( $atts['category__not_in'] ) ) {
			$atts['category__not_in'] = array_filter( array_map( 'trim', explode( ',', trim( $atts['category__not_in'] ) ) ) );
		} else {
			unset( $atts['category__not_in'] );
		}

		/* Make sure the tag__not_in parameter is an array */
		if( is_string( $atts['tag__not_in'] ) && '' !== trim( $atts['tag__not_in'] ) ) {
			$atts['tag__not_in'] = array_filter( array_map( 'trim', explode( ',', trim( $atts['tag__not_in'] ) ) ) );
		} else {
			unset( $atts['tag__not_in'] );
		}

		/* Start Querying Posts */
		$wp_query = new WP_Query( $atts );

		if( $wp_query->have_posts() ):

			/* Modify excerpt length */
			add_filter( 'excerpt_length', 'hydrogen_posts_shortcode_excerpt_length', 999 );

			/* Trigger attachments caching */
			hydrogen_posts_shortcode_cache_media_attachments( $wp_query );

			/* Start output */
			$output .= '<div class="owl-carousel items-carousel"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			while( $wp_query->have_posts() ): $wp_query->the_post();

				$recent_post_class = 'recent-post';
				$post_format = get_post_format();
				$post_format_meta = hydrogen_extract_post_format_meta();

				if( in_array( $post_format, (array) $supported_post_formats ) ) {
					$recent_post_class .= ' post-' . $post_format;
				}

				$output .= '<div class="carousel-item">';

					$output .= '<div class="' . $recent_post_class . '">';

						$post_media = hydrogen_posts_shortcode_media( $post_format_meta );
						$post_body  = hydrogen_posts_shortcode_body();

						if( 'audio' == $post_format && 'hosted' == $post_format_meta['type'] ) {
							$output .= $post_body . $post_media;
						} elseif( 'quote' == $post_format ) {
							$output .= $post_media;
						} else {
							$output .= $post_media . $post_body;
						}

					$output .= '</div>';

				$output .= '</div>';

			endwhile;

			$output .= '</div>';

			/* Restore excerpt length */
			remove_filter( 'excerpt_length', 'hydrogen_posts_shortcode_excerpt_length' );

		endif;

		$post = $tmp_post;
		if( is_a( $post, 'WP_Post' ) ) {
			setup_postdata( $post );
		}

		return $output;
	}
endif;
add_filter( 'youxi_shortcode_posts_callback', create_function( '', 'return "hydrogen_posts_shortcode_cb";' ) );

/**
 * Posts shortcode styles
 */
if( ! function_exists( 'hydrogen_posts_shortcode_styles' ) ):

	function hydrogen_posts_shortcode_styles( $styles ) {
		return array_merge( $styles, hydrogen_get_styles( array( 'owl-carousel', 'royalslider', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_posts_styles', 'hydrogen_posts_shortcode_styles' );

/**
 * Slider shortcode scripts
 */
if( ! function_exists( 'hydrogen_posts_shortcode_scripts' ) ):

	function hydrogen_posts_shortcode_scripts( $scripts ) {
		return array_merge( $scripts, hydrogen_get_scripts( array( 'owl-carousel', 'royalslider', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_posts_scripts', 'hydrogen_posts_shortcode_scripts' );

/* ==========================================================================
	Pricing Table
============================================================================= */

/**
 * Pricing Table shortcode callback
 */
if( ! function_exists( 'hydrogen_pricing_table_shortcode_cb' ) ):

	function hydrogen_pricing_table_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		switch( $btn_action ) {
			case 'page':
				$url = get_permalink( $post_id );
				$url = $url ? $url : '#';
				break;
		}

		$o = '<div class="pricing-table' . ( $featured ? ' featured' : '' ) . '"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			if( $show_price ):

			$o .= '<h2 class="price">';
				$o .= esc_html( $currency );
				$o .= esc_html( $price );
				$o .= '<small>' . esc_html( $price_description ) . '</small>';
			$o .= '</h2>';
			
			endif;

			$o .= '<h5 class="name">' . esc_html( $title ) . '</h5>';

			$o .= '<div class="features">';
				$o .= $content;
			$o .= '</div>';

			if( $show_btn ):

			$o .= '<a href="' . esc_url( $url ) . '" class="btn btn-sm btn-' . esc_attr( $color ) . ' btn-block">';
				$o .= esc_html( $btn_text );
			$o .= '</a>';

			endif;

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_pricing_table_callback', create_function( '', 'return "hydrogen_pricing_table_shortcode_cb";' ) );

/**
 * Make pricing table shortcode external
 */
add_filter( 'youxi_shortcode_pricing_table_internal', '__return_false' );

/* ==========================================================================
	Progressbar
============================================================================= */

/**
 * Progressbar shortcode atts
 */
if( ! function_exists( 'hydrogen_progressbar_shortcode_atts' ) ):

	function hydrogen_progressbar_shortcode_atts( $atts ) {

		return array_merge( array(
			'label' => array(
				'type' => 'text', 
				'label' => __( 'Label', 'youxi' ), 
				'description' => __( 'Enter here the progressbar label.', 'youxi' ), 
				'std' => ''
			), 
			'size' => array(
				'type' => 'select', 
				'label' => __( 'Size', 'youxi' ), 
				'description' => __( 'Choose here the progressbar size.', 'youxi' ), 
				'choices' => array(
					0 => __( 'Default', 'youxi' ), 
					'lg' => __( 'Large', 'youxi' ), 
					'sm' => __( 'Small', 'youxi' ), 
					'xs' => __( 'Extra Small', 'youxi' )
				), 
				'std' => 0
			)
		), $atts );
	}
endif;
add_filter( 'youxi_shortcode_progressbar_atts', 'hydrogen_progressbar_shortcode_atts' );

/**
 * Progressbar shortcode callback
 */
if( ! function_exists( 'hydrogen_progressbar_shortcode_cb' ) ):

	function hydrogen_progressbar_shortcode_cb( $atts, $content, $tag ) {

		$container_classes = array( 'progress' );
		$bar_classes = array( 'progress-bar' );

		extract( $atts, EXTR_SKIP );

		if( $type ) {
			$bar_classes[] = "progress-bar-{$type}";
		}
		if( $striped ) {
			$container_classes[] = "progress-striped";
		}
		if( $size ) {
			$container_classes[] = "progress-{$size}";
		}
		if( $active ) {
			$container_classes[] = 'active';
		}

		$o = '<div class="progress-counter">';

			if( $label ):
				$o .= '<span class="progress-label">' . esc_html( $label ) . '</span>';
			endif;

			$o .= '<div class="' . join( ' ', $container_classes ) . '" data-value="' . esc_attr( $value ) . '">';
				$o .= '<div class="' . join( ' ', $bar_classes ) . '" role="progressbar" aria-valuenow="' . esc_attr( $value ) . '" aria-valuemin="0" aria-valuemax="100"></div>';
			$o .= '</div>';

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_progressbar_callback', create_function( '', 'return "hydrogen_progressbar_shortcode_cb";' ) );

/* ==========================================================================
	Row
============================================================================= */

/**
 * Row shortcode callback
 */
if( ! function_exists( 'hydrogen_row_shortcode_cb' ) ):

	function hydrogen_row_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$attributes = array(
			'class' => 'row'
		);

		if( ! empty( $extra_classes ) ) {
			$attributes['class'] .= ' ' . sanitize_html_class( trim( $extra_classes ) );
		}

		if( $animation_offset != 75 ) {
			$attributes['data-waypoint-offset'] = $animation_offset . '%';
		}

		if( $animation_duration >= 0 ) {
			$attributes['data-animation-duration'] = $animation_duration;
		}

		if( ! $distribute_animation ) {
			if( $animation_chain_delay >= 0 ) {
				$attributes['data-animation-chain-delay'] = $animation_chain_delay;
			}
		} else {
			if( $animation_chain_duration >= 0 ) {
				$attributes['data-animation-chain-duration'] = $animation_chain_duration;
			}
		}

		$html = '';
		foreach( $attributes as $key => $option ) {
			$html .= " {$key}=\"" . esc_attr( $option ) . "\"";
		}

		return '<div' . $html . '>' . do_shortcode( $content ) . '</div>';
	}
endif;
add_filter( 'youxi_shortcode_row_callback', create_function( '', 'return "hydrogen_row_shortcode_cb";' ) );

/**
 * Row shortcode atts
 */
if( ! function_exists( 'hydrogen_row_shortcode_atts' ) ):

	function hydrogen_row_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'animation_offset' => array(
				'type' => 'uislider', 
				'label' => __( 'Animation Offset', 'youxi' ), 
				'description' => __( 'Specify the distance from top of the screen before animation is triggered (%).', 'youxi' ), 
				'std' => 75, 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 100
				)
			), 
			'animation_duration' => array(
				'type' => 'uislider', 
				'label' => __( 'Animation Duration', 'youxi' ), 
				'description' => __( 'Specify the default animation duration in milliseconds for all elements in this row (-1 means unspecified).', 'youxi' ), 
				'std' => -1, 
				'widgetopts' => array(
					'min' => -1, 
					'max' => 1000
				)
			), 
			'distribute_animation' => array(
				'type' => 'switch', 
				'label' => __( 'Distribute Animation', 'youxi' ), 
				'description' => __( 'Switch to distribute chained animation delay between all elements in this row.', 'youxi' ), 
				'std' => true
			), 
			'animation_chain_duration' => array(
				'type' => 'uislider', 
				'label' => __( 'Animation Chain Duration', 'youxi' ), 
				'description' => __( 'Specify the chained animation duration to be distributed between all elements in this row (-1 means unspecified).', 'youxi' ), 
				'std' => -1, 
				'widgetopts' => array(
					'min' => -1, 
					'max' => 1000
				), 
				'criteria' => 'distribute_animation:is(1)'
			), 
			'animation_chain_delay' => array(
				'type' => 'uislider', 
				'label' => __( 'Animation Chain Delay', 'youxi' ), 
				'description' => __( 'Specify the chained animation delay for all elements in this row (-1 means unspecified).', 'youxi' ), 
				'std' => -1, 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 1000
				), 
				'criteria' => 'distribute_animation:is(0)'
			), 
			'extra_classes' => array(
				'type' => 'text', 
				'label' => __( 'Extra CSS Classes', 'youxi' ), 
				'description' => __( 'Enter here your custom CSS classes to apply to the row.', 'youxi' ), 
				'std' => ''
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_row_atts', 'hydrogen_row_shortcode_atts' );

/* ==========================================================================
	Separator
============================================================================= */

/**
 * Separator shortcode callback
 */
if( ! function_exists( 'hydrogen_separator_shortcode_cb' ) ):

	function hydrogen_separator_shortcode_cb( $atts, $content, $tag ) {
		return '<div class="spacer-' . esc_attr( $atts['size'] ) . '"></div>';
	}
endif;
add_filter( 'youxi_shortcode_separator_callback', create_function( '', 'return "hydrogen_separator_shortcode_cb";' ) );

/**
 * Separator shortcode atts
 */
if( ! function_exists( 'hydrogen_separator_shortcode_atts' ) ):

	function hydrogen_separator_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'size' => array(
				'type' => 'uislider', 
				'label' => __( 'Separator Size', 'youxi' ), 
				'description' => __( 'Choose the height of the separator.', 'youxi' ), 
				'widgetopts' => array(
					'min' => 10, 
					'max' => 140, 
					'step' => 10
				), 
				'std' => 10
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_separator_atts', 'hydrogen_separator_shortcode_atts' );

/* ==========================================================================
	Service
============================================================================= */

/**
 * Service shortcode callback
 */
if( ! function_exists( 'hydrogen_service_shortcode_cb' ) ):

	function hydrogen_service_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$o = '<div class="service"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			$o .= '<div class="service-icon">';
				$o .= '<i class="' . esc_attr( $icon ) . '"' . hydrogen_arr_get( $animate, 'icon' ) . '></i>';
				$o .= '<i class="' . esc_attr( $icon ) . ' shadow-icon"' . hydrogen_arr_get( $animate, 'shadow-icon' ) . '></i>';
			$o .= '</div>';
			$o .= '<div class="service-info">';
				$o .= '<h4 class="service-name">' . $title . '</h4>';
				$o .= wpautop( wp_kses_post( $content ) );
			$o .= '</div>';

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_service_callback', create_function( '', 'return "hydrogen_service_shortcode_cb";' ) );

/**
 * Service shortcode atts
 */
if( ! function_exists( 'hydrogen_service_shortcode_atts' ) ):

	function hydrogen_service_shortcode_atts( $atts ) {

		foreach( array( 'show_btn', 'btn_text', 'btn_type', 'btn_action', 'post_id', 'url' ) as $attribute ) {
			unset( $atts[ $attribute ] );
		}

		return array_merge( $atts, array(
			'icon' => array(
				'type' => 'iconchooser', 
				'label' => __( 'Icon', 'youxi' ), 
				'description' => __( 'Choose here the icon to display on the service item.', 'youxi' ), 
				'std' => 'glyphicons-display', 
				'assets' => array(
					get_template_directory_uri() . '/assets/icons/style.css', 
				), 
				'choices' => array( 
					'glyphicons' => array(
						'icons' => hydrogen_glyphicons_choices(), 
						'label' => __( 'Glyphicons', 'youxi' )
					), 
					'font-awesome' => array(
						'icons' => hydrogen_fontawesome_choices(), 
						'label' => __( 'Font Awesome', 'youxi' )
					), 
					'socicon' => array(
						'icons' => hydrogen_socicon_choices(), 
						'label' => __( 'Socicon', 'youxi' )
					)
				)
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_service_atts', 'hydrogen_service_shortcode_atts' );

/* ==========================================================================
	Slider
============================================================================= */

/**
 * Slider shortcode atts
 */
if( ! function_exists( 'hydrogen_slider_shortcode_atts' ) ):

	function hydrogen_slider_shortcode_atts( $atts ) {

		unset( $atts['interval'] );

		$atts['controls']['std'] = array(
			'pagers' => false, 
			'arrows' => true
		);

		if( isset( $atts['behaviors'] ) && is_array( $atts['behaviors'] ) ) {
			$atts['behaviors'] = array_merge( $atts['behaviors'], array(
				'inline' => false, 
				'choices' => array(
					'loop' => __( 'Allow the Slider to Go From Last to First Slide', 'youxi' ), 
					'randomize-slides' => __( 'Randomize the Order of the Slides', 'youxi' ), 
					'navigate-by-click' => __( 'Navigate Forward by Clicking on Slide', 'youxi' ), 
					'slider-drag' => __( 'Enable Mouse Drag Navigation', 'youxi' ), 
					'slider-touch' => __( 'Enable Touch Navigation', 'youxi' )
				), 
				'std' => array(
					'loop' => false, 
					'randomize-slides' => false, 
					'navigate-by-click' => true, 
					'slider-drag' => true, 
					'slider-touch' => true
				)
			));
		}

		return array_merge( $atts, array(
			'type' => array(
				'type' => 'select', 
				'label' => __( 'Slider Type', 'youxi' ), 
				'description' => __( 'Choose the slider type.', 'youxi' ), 
				'std' => 'standard-slider', 
				'choices' => array(
					'standard-slider' => __( 'Standard Slider', 'youxi' ), 
					'macbook-slider' => __( 'MacBook Slider', 'youxi' ), 
					'iphone-slider' => __( 'iPhone Slider', 'youxi' ), 
					'ipad-slider' => __( 'iPad Slider', 'youxi' ), 
					'nearby-slider' => __( 'Visible Nearby Slider', 'youxi' ), 
				)
			), 
			'orientation' => array(
				'type' => 'radio', 
				'label' => __( 'Slider Orientation', 'youxi' ), 
				'description' => __( 'Choose the slider orientation.', 'youxi' ), 
				'std' => 'horizontal', 
				'choices' => array(
					'horizontal' => __( 'Horizontal', 'youxi' ), 
					'vertical' => __( 'Vertical', 'youxi' )
				)
			), 
			'transition' => array(
				'type' => 'radio', 
				'label' => __( 'Slider Transition', 'youxi' ), 
				'description' => __( 'Choose the slider transition.', 'youxi' ), 
				'std' => 'move', 
				'choices' => array(
					'move' => __( 'Move', 'youxi' ), 
					'fade' => __( 'Fade', 'youxi' )
				)
			), 
			'speed' => array(
				'type' => 'uislider', 
				'label' => __( 'Transition Speed', 'youxi' ), 
				'description' => __( 'Enter the slider transition speed.', 'youxi' ), 
				'std' => 600, 
				'widgetopts' => array(
					'min' => 100, 
					'max' => 4000
				)
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_slider_atts', 'hydrogen_slider_shortcode_atts' );

/**
 * Slider shortcode styles
 */
if( ! function_exists( 'hydrogen_slider_shortcode_styles' ) ):

	function hydrogen_slider_shortcode_styles( $styles ) {
		return array_merge( $styles, hydrogen_get_styles( array( 'royalslider', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_slider_styles', 'hydrogen_slider_shortcode_styles' );

/**
 * Slider shortcode scripts
 */
if( ! function_exists( 'hydrogen_slider_shortcode_scripts' ) ):

	function hydrogen_slider_shortcode_scripts( $scripts ) {
		return array_merge( $scripts, hydrogen_get_scripts( array( 'royalslider', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_slider_scripts', 'hydrogen_slider_shortcode_scripts' );

/**
 * Slider shortcode content
 */
if( ! function_exists( 'hydrogen_slider_shortcode_content' ) ):

	function hydrogen_slider_shortcode_content( $content ) {

		$content['fields'] = array(
			'title' => array(
				'type' => 'text', 
				'label' => __( 'Title', 'youxi' ), 
				'title' => __( 'Enter here the title of the slide.', 'youxi' )
			), 
			'image' => array(
				'type' => 'image', 
				'label' => __( 'Image', 'youxi' ), 
				'description' => __( 'Choose an image for the slide.', 'youxi' ), 
				'return_type' => 'url', 
				'frame_title' => __( 'Choose an Image', 'youxi' ), 
				'frame_btn_text' => __( 'Insert URL', 'youxi' ), 
				'upload_btn_text' => __( 'Choose an Image', 'youxi' )
			), 
			'is_video' => array(
				'type' => 'switch', 
				'label' => __( 'Video Slide', 'youxi' ), 
				'description' => __( 'Switch to make a video slide (YouTube/Vimeo).', 'youxi' ), 
				'std' => false
			), 
			'url' => array(
				'type' => 'url', 
				'label' => __( 'URL/Video URL', 'youxi' ), 
				'description' => __( 'Enter the URL/Video URL (YouTube/Vimeo).', 'youxi' )
			)
		);

		return $content;
	}
endif;
add_filter( 'youxi_shortcode_slider_content', 'hydrogen_slider_shortcode_content' );

/**
 * Slider shortcode callback
 */
if( ! function_exists( 'hydrogen_slider_shortcode_cb' ) ):

	function hydrogen_slider_shortcode_cb( $atts, $content, $tag ) {
		
		extract( $atts, EXTR_SKIP );

		/* Validate slider type */
		if( ! preg_match( '/^(standard|macbook|ip(hone|ad)|nearby)-slider$/', $type ) ) {
			$type = 'standard-slider';
		}

		$options = array();

		// Behaviors
		$behaviors = explode( ',', $behaviors );
		$default_behaviors = array( 'navigate-by-click', 'slider-drag', 'slider-touch' );
		foreach( array( 'loop', 'randomize-slides', 'navigate-by-click', 'slider-drag', 'slider-touch' ) as $behavior ) {
			if( in_array( $behavior, $behaviors ) ) {
				if( ! in_array( $behavior, $default_behaviors ) ) {
					$options[ "data-{$behavior}" ] = 'true';
				}
			} else if( in_array( $behavior, $default_behaviors ) ) {
				$options[ "data-{$behavior}" ] = 'false';
			}
		}

		// Controls
		$controls = explode( ',', $controls );
		$options['data-control-navigation'] = in_array( 'pagers', $controls ) ? 'bullets' : 'none';
		if( ! in_array( 'arrows', $controls ) ) {
			$options['data-arrows-nav'] = 'false';
		}

		// Orientation
		if( 'horizontal' != $orientation ) {
			$options['data-slides-orientation'] = $orientation;
		}

		// Transition
		if( 'move' != $transition ) {
			$options['data-transition-type'] = $transition;
		}

		// Transition speed
		$options['data-transition-speed'] = $speed;

		// Construct options html
		$html = '';
		foreach( $options as $key => $option ) {
			$html .= " {$key}=\"" . esc_attr( $option ) . "\"";
		}

		$o = '<div class="' . $type . '">';

			$slider_content = '<div class="royalSlider rsHydrogen"' . $html . '>';
				$slider_content .= do_shortcode( $content );
			$slider_content .= '</div>';

			if( preg_match( '/^(macbook|ip(hone|ad))-slider$/', $type ) ) {
				$o .= '<div class="wrap">';
					$o .= $slider_content;
				$o .= '</div>';
			} else {
				$o .= $slider_content;
			}

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_slider_callback', create_function( '', 'return "hydrogen_slider_shortcode_cb";' ) );

/**
 * Slide shortcode atts
 */
if( ! function_exists( 'hydrogen_slide_shortcode_atts' ) ):

	function hydrogen_slide_shortcode_atts( $atts ) {
		return array_merge( $atts, array(
			'is_video' => array(
				'std' => false
			), 
			'url' => array()
		));
	}
endif;
add_filter( 'youxi_shortcode_slide_atts', 'hydrogen_slide_shortcode_atts' );

/**
 * Slide shortcode content
 */
add_filter( 'youxi_shortcode_slide_content', '__return_empty_array' );

/**
 * Slide shortcode callback
 */
if( ! function_exists( 'hydrogen_slide_shortcode_cb' ) ):

	function hydrogen_slide_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );
		
		$o = '<div class="slider-media">';

			$o .= '<figure>';

				$o .= '<img src="' . esc_url( $image ) . '" class="rsImg"';

				if( $is_video && ! empty( $url ) ):
					$o .= ' data-rsVideo="' . esc_url( $url ) . '"';
				endif;

				$o .= ' alt="' . esc_attr( $title ) . '">';

				$o .= '<figcaption>';
					$o .= '<span>' . esc_html( $title ) . '</span>';
				$o .= '</figcaption>';

			$o .= '</figure>';

			if( ! $is_video || empty( $url ) ):

			$o .= '<div class="overlay transparent">';

				$o .= '<ul>';

					$o .= '<li class="mfp-zoom">';
						$o .= '<a href="' . esc_url( $image ) . '">';
							$o .= '<i class="gi gi-resize-full"></i>';
						$o .= '</a>';
					$o .= '</li>';

					if( ! empty( $url ) ):

					$o .= '<li class="mfp-details">';
						$o .= '<a href="' . esc_url( $url ) . '">';
							$o .= '<i class="gi gi-search"></i>';
						$o .= '</a>';
					$o .= '</li>';

					endif;

				$o .= '</ul>';

			$o .= '</div>';

			endif;

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_slide_callback', create_function( '', 'return "hydrogen_slide_shortcode_cb";' ) );

/* ==========================================================================
	Table
============================================================================= */

/**
 * Table shortcode output filter
 */
if( ! function_exists( 'hydrogen_table_shortcode_output' ) ):

	function hydrogen_table_shortcode_output( $html, $atts ) {

		$anim_html = hydrogen_arr_get( $atts['animate'], 'self' );
		if( '' !== $anim_html ) {
			return '<div class="table-wrapper"' . $anim_html . '>' . $html . '</div>';
		}
		return $html;
	}
endif;
add_filter( 'youxi_shortcode_table_output', 'hydrogen_table_shortcode_output', 10, 2 );

/* ==========================================================================
	Tabs
============================================================================= */

/**
 * Tabs shortcode output filter
 */
if( ! function_exists( 'hydrogen_tabs_shortcode_output' ) ):

	function hydrogen_tabs_shortcode_output( $html, $atts ) {
		return '<div class="tab-widget"' . hydrogen_arr_get( $atts['animate'], 'self' ) . '>' . $html . '</div>';
	}
endif;
add_filter( 'youxi_shortcode_tabs_output', 'hydrogen_tabs_shortcode_output', 10, 2 );

/* ==========================================================================
	Team
============================================================================= */

/**
 * Team shortcode callback
 */
if( ! function_exists( 'hydrogen_team_shortcode_cb' ) ):

	function hydrogen_team_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		/* Parse social profiles */
		if( $social_profiles = explode( '|', $social ) ) {

			foreach( $social_profiles as $key => $profile ) {

				$profile = explode( ',', $profile );

				if( count( $profile ) >= 2 ) {

					$social_profiles[ $key ] = array(
						'icon' => $profile[0], 
						'url' => $profile[1]
					);
				} else {
					unset( $social_profiles[ $key ] );
				}
			}
		}

		$o = '<div class="team"' . hydrogen_arr_get( $animate, 'self' ) . '>';

			$o .= '<div class="team-photo">';

				$o .= '<figure>';

					$o .= '<img src="' . esc_url( $photo ) . '" alt="' . esc_attr( $name ) . '">';

					$o .= '<figcaption>';

						$o .= '<a href="#">';
							$o .= '<i class="gi gi-resize-full"></i>';
						$o .= '</a>';

					$o .= '</figcaption>';

				$o .= '</figure>';

			$o .= '</div>';

			$o .= '<div class="team-info">';
			
				$o .= '<h4 class="team-name">' . esc_html( $name ) . '</h4>';
				$o .= '<p class="team-role">' . esc_html( $role ) . '</p>';

			$o .= '</div>';

			$o .= '<div class="team-data" data-name="' . esc_attr( $name ) . '" data-role="' . esc_attr( $role ) . '" data-photo="' . esc_attr( $photo ) . '">';

				$o .= wpautop( wp_kses_post( $content ) );

				if( is_array( $social_profiles ) && ! empty( $social_profiles ) ) {

					$o .= '<div class="spacer-60 bordered"></div>';

					$o .= '<div class="social-list">';

						$o .= '<ul>';

						foreach( $social_profiles as $profile ) {

							$o .= '<li>';

								$o .= '<a href="' . esc_url( $profile['url'] ) . '">';

									$o .= '<i class="' . esc_attr( $profile['icon'] ) . '"></i>';

								$o .= '</a>';

							$o .= '</li>';

						}

						$o .= '</ul>';

					$o .= '</div>';

				}

			$o .= '</div>';

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_team_callback', create_function( '', 'return "hydrogen_team_shortcode_cb";' ) );

/**
 * Team shortcode atts
 */
if( ! function_exists( 'hydrogen_team_shortcode_atts' ) ):

	function hydrogen_team_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'social' => array(
				'type' => 'repeater', 
				'fieldset' => 'social', 
				'label' => __( 'Social Profiles', 'youxi' ), 
				'description' => __( 'Specify the social profiles of this team member.', 'youxi' ), 
				'preview_template' => '{{ data.url }}', 
				'min' => 0, 
				'fields' => array(
					'icon' => array(
						'type' => 'select', 
						'label' => __( 'Icon', 'youxi' ), 
						'choices' => hydrogen_socicon_choices(), 
						'description' => __( 'Choose here the profile icon.', 'youxi' )
					), 
					'url' => array(
						'type' => 'text', 
						'label' => __( 'URL', 'youxi' ), 
						'description' => __( 'Enter here the profile URL.', 'youxi' )
					)
				), 
				'serialize' => 'js:function( data ) {
					return $.map( data, function( p ) {
						return $.map( p, function( v ) {
							return v;
						}).join( "," );
					}).join( "|" );
				}', 
				'deserialize' => 'js:function( data ) {
					return $.map( ( data + "" ).split( "|" ), function( p ) {
						p = ( p + "" ).split( "," );
						if( p.length >= 2 ) {
							return { icon: p[0], url: p[1] };
						}
					});
				}'
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_team_atts', 'hydrogen_team_shortcode_atts' );

/**
 * Team shortcode fieldsets
 */
if( ! function_exists( 'hydrogen_team_shortcode_fieldsets' ) ):

function hydrogen_team_shortcode_fieldsets( $fieldsets ) {
	return array_merge( $fieldsets, array(
		'social' => array(
			'id' => 'social', 
			'title' => __( 'Social', 'youxi' )
		)
	));
}
endif;
add_filter( 'youxi_shortcode_team_fieldsets', 'hydrogen_team_shortcode_fieldsets' );

/**
 * Team shortcode styles
 */
if( ! function_exists( 'hydrogen_team_shortcode_styles' ) ):

	function hydrogen_team_shortcode_styles( $styles ) {
		return array_merge( $styles, hydrogen_get_styles( 'magnific-popup' ) );
	}
endif;
add_filter( 'youxi_shortcode_team_styles', 'hydrogen_team_shortcode_styles' );

/**
 * Team shortcode scripts
 */
if( ! function_exists( 'hydrogen_team_shortcode_scripts' ) ):

	function hydrogen_team_shortcode_scripts( $scripts ) {
		return array_merge( $scripts, hydrogen_get_scripts( 'magnific-popup' ) );
	}
endif;
add_filter( 'youxi_shortcode_team_scripts', 'hydrogen_team_shortcode_scripts' );

/* ==========================================================================
	Testimonial
============================================================================= */

/**
 * Testimonials shortcode callback
 */
if( ! function_exists( 'hydrogen_testimonials_shortcode_cb' ) ):

	function hydrogen_testimonials_shortcode_cb( $atts, $content, $tag ) {

		$attributes = array(
			'class' => 'testimonial-slider owl-carousel', 
			'data-auto-height' => 'true', 
			'data-single-item' => 'true'
		);

		$html = '';
		foreach( $attributes as $key => $val ) {
			$html .= " {$key}=\"" . esc_attr( $val ) . '"';
		}

		$o = '<div' . $html . hydrogen_arr_get( $atts['animate'], 'self' ) . '>';
			$o .= do_shortcode( $content );
		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_testimonials_callback', create_function( '', 'return "hydrogen_testimonials_shortcode_cb";' ) );

/**
 * Testimonials shortcode styles
 */
if( ! function_exists( 'hydrogen_testimonials_shortcode_styles' ) ):

	function hydrogen_testimonials_shortcode_styles( $styles ) {
		return array_merge( $styles, hydrogen_get_styles( 'owl-carousel' ) );
	}
endif;
add_filter( 'youxi_shortcode_testimonials_styles', 'hydrogen_testimonials_shortcode_styles' );

/**
 * Testimonials shortcode scripts
 */
if( ! function_exists( 'hydrogen_testimonials_shortcode_scripts' ) ):

	function hydrogen_testimonials_shortcode_scripts( $scripts ) {
		return array_merge( $scripts, hydrogen_get_scripts( 'owl-carousel' ) );
	}
endif;
add_filter( 'youxi_shortcode_testimonials_scripts', 'hydrogen_testimonials_shortcode_scripts' );

/**
 * Testimonial shortcode callback
 */
if( ! function_exists( 'hydrogen_testimonial_shortcode_cb' ) ):

	function hydrogen_testimonial_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$o = '<div class="testimonial">';

			$o .= '<blockquote>';

				$o .= wpautop( $content );

				$o .= '<small>';

					$o .= esc_html( $author );

					if( '' !== $source_url ):
					$o .= ', <cite><a href="' . esc_url( $source_url ) . '">' . esc_html( $source ) . '</a></cite>';
					else:
					$o .= ', <cite>' . esc_html( $source ) . '</cite>';
					endif;

				$o .= '</small>';

			$o .= '</blockquote>';

		$o .= '</div>';

		return $o;
	}
endif;
add_filter( 'youxi_shortcode_testimonial_callback', create_function( '', 'return "hydrogen_testimonial_shortcode_cb";' ) );

/* ==========================================================================
	Text Widget
============================================================================= */

/**
 * Text width shortcode output filter
 */
if( ! function_exists( 'hydrogen_text_widget_shortcode_output' ) ):

	function hydrogen_text_widget_shortcode_output( $html, $atts ) {

		$anim_html = hydrogen_arr_get( $atts['animate'], 'self' );
		if( '' !== $anim_html ) {
			return '<div' . $anim_html . '>' . $html . '</div>';
		}
		return $html;
	}
endif;
add_filter( 'youxi_shortcode_text_widget_output', 'hydrogen_text_widget_shortcode_output', 10, 2 );

/* ==========================================================================
	Twitter
============================================================================= */

/**
 * Twitter shortcode atts
 */
if( ! function_exists( 'hydrogen_twitter_shortcode_atts' ) ):

	function hydrogen_twitter_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'layout' => array(
				'type' => 'select', 
				'label' => __( 'Tweets Layout', 'youxi' ), 
				'description' => __( 'Choose here the Twitter layout mode.', 'youxi' ), 
				'choices' => array(
					'tweet-slider' => __( 'Tweets Slider', 'youxi' )
				), 
				'std' => 'tweet-slider'
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_twitter_atts', 'hydrogen_twitter_shortcode_atts' );

/**
 * Twitter shortcode callback
 */
if( ! function_exists( 'hydrogen_twitter_shortcode_cb' ) ):

	function hydrogen_twitter_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		if( ! in_array( $layout, array( 'tweet-slider' ) ) ) {
			$layout = 'tweet-slider';
		}

		return '<div class="twitter ' . esc_attr( $layout ) . '" data-username="' . esc_attr( $username ) . '" data-count="' . esc_attr( $count ) . '" data-ajax-action="youxi_get_tweets"' . hydrogen_arr_get( $animate, 'self' ) . '></div>';
	}
endif;
add_filter( 'youxi_shortcode_twitter_callback', create_function( '', 'return "hydrogen_twitter_shortcode_cb";' ) );
