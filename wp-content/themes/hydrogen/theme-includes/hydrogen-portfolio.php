<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Get portfolio attachment images
 */
if( ! function_exists( 'hydrogen_portfolio_attachment_images' ) ):

function hydrogen_portfolio_attachment_images( $attachments, $before = '', $after = '', $attr = array(), $size = 'full' ) {

	// Trigger caching to reduce SQL queries
	hydrogen_trigger_attachments_caching( $attachments );

	$o = '';
	foreach( $attachments as $attachment ) {
		$attachment_image = wp_get_attachment_image( $attachment, $size, false, $attr );
		if( $attachment_image ) {
			$o .= $before . $attachment_image . $after;
		}
	}

	return $o;
}
endif;

/**
 * Count portfolio posts
 */
if( ! function_exists( 'hydrogen_portfolio_count' ) ):

function hydrogen_portfolio_count( $exclude = '' ) {
	$args = array(
		'post_type' => youxi_portfolio_cpt_name(), 
		'posts_per_page' => -1, 
		'update_post_meta_cache' => false, 
		'update_post_term_cache' => false, 
		'suppress_filters' => false
	);

	// Make sure not to query empty taxonomy names
	$exclude = array_filter( $exclude );
	
	if( $exclude ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => youxi_portfolio_tax_name(), 
				'field' => 'id', 
				'terms' => $exclude, 
				'operator' => 'NOT IN'
			)
		);
	}

	$query = new WP_Query( $args );
	return $query->found_posts;
}
endif;

/**
 * Portfolio JS Vars
 */
if( ! function_exists( 'hydrogen_portfolio_js_vars' ) ):

function hydrogen_portfolio_js_vars( $vars ) {
	return array_merge( $vars, array(
		'portfolio' => array(
			'defaults' => hydrogen_portfolio_defaults(), 
			'ajax_action' => hydrogen_portfolio_ajax_action()
		)
	));
}
endif;
add_filter( 'hydrogen_js_vars', 'hydrogen_portfolio_js_vars' );

/**
 * Portfolio Defaults
 */
if( ! function_exists( 'hydrogen_portfolio_defaults' ) ):

function hydrogen_portfolio_defaults() {
	return apply_filters( 'hydrogen_portfolio_defaults', array(
		'show_title' => true, 
		'ajax_loading' => true, 
		'posts_per_page' => 8, 
		'orderby' => 'post_date', 
		'view_method' => 'ajax', 
		'thumbnail_size' => 'post-thumbnail', 
		'exclude' => ''
	));
}
endif;

/**
 * Portfolio AJAX Action
 */
if( ! function_exists( 'hydrogen_portfolio_ajax_action' ) ):

function hydrogen_portfolio_ajax_action() {
	return apply_filters( 'hydrogen_portfolio_ajax_action', 'load_portfolio_posts' );
}
endif;

/**
 * Portfolio Image Sizes
 */
if( ! function_exists( 'hydrogen_add_portfolio_image_sizes' ) ):

function hydrogen_add_portfolio_image_sizes( $sizes ) {
	
	return array_merge( $sizes, array(
		'portfolio_4by3' => array(
			'width' => 720, 
			'height' => 540, 
			'crop' => true, 
			'label' => __( 'Portfolio 4:3', 'youxi' )
		), 
		'portfolio_16by9' => array(
			'width' => 720, 
			'height' => 405, 
			'crop' => true, 
			'label' => __( 'Portfolio 16:9', 'youxi' )
		), 
		'portfolio_square' => array(
			'width' => 720, 
			'height' => 720,
			'crop' => true, 
			'label' => __( 'Portfolio Square', 'youxi' )
		)
	));
}
endif;
add_filter( 'hydrogen_wp_image_sizes', 'hydrogen_add_portfolio_image_sizes' );

/**
 * Determine portfolio section classes
 */
if( ! function_exists( 'hydrogen_portfolio_classes' ) ):

function hydrogen_portfolio_classes( $section, $type ) {

	if( 'media' == $section ) {

		$classes = ' project-media %s-padding-top %s-padding-bottom shadow-bg';

		if( 'photoset' == $type ) {
			return sprintf( $classes, 'no', 'no' );
		}

		return sprintf( $classes, 'half', 'half' );

	} else if( 'description' == $section ) {

		$classes = ' project-description %s-padding-top half-padding-bottom ';

		if( preg_match( '/^(ip(hone|ad)|macbook)-slider$/', $type ) ) {
			return sprintf( $classes, 'three-quarters' );
		}

		return sprintf( $classes, 'half' );
	}
}
endif;

/**
 * Portfolio Ajax Loading
 */
if( ! function_exists( 'hydrogen_load_portfolio_posts' ) ):

function hydrogen_load_portfolio_posts() {

	$response = array(
		'status' => 'error', 
		'message' => null, 
		'html' => null
	);

	if( isset( $_GET['params'] ) && is_array( $_GET['params'] ) ) {

		$template = locate_template( 'template-parts/portfolio/index.php' );

		if( '' !== $template ) {

			$defaults = array_merge( hydrogen_portfolio_defaults(), array( 'offset' => 0 ) );
			extract( wp_parse_args( $_GET['params'], $defaults ), EXTR_SKIP );

			ob_start();
			include( $template );

			$response['html'] = ob_get_clean();
			$response['status'] = ( hydrogen_portfolio_count( $exclude ) <= $offset + $posts_per_page ) ? 'finished' : 'success';
		} else {
			$response['message'] = __( 'The portfolio index template can not be found.', 'youxi' );
		}

	} else {
		$response['message'] = __( 'The portfolio posts request is invalid.', 'youxi' );
	}

	wp_send_json( $response );
}
endif;
add_action( 'wp_ajax_' . hydrogen_portfolio_ajax_action(), 'hydrogen_load_portfolio_posts' );
add_action( 'wp_ajax_nopriv_' . hydrogen_portfolio_ajax_action(), 'hydrogen_load_portfolio_posts' );
