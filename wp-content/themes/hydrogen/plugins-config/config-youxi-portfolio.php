<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_PORTFOLIO_VERSION' ) ) {
	return;
}

/* ==========================================================================
	Portfolio General
============================================================================= */

/**
 * Modify shortcode tag
 */
if( ! function_exists( 'hydrogen_portfolio_shortcode_tag' ) ):

function hydrogen_portfolio_shortcode_tag( $tag ) {
	return 'portfolio';
}
endif;
add_filter( 'youxi_portfolio_shortcode_tag', 'hydrogen_portfolio_shortcode_tag' );

/**
 * Add the tinymce and page builder to one page blocks
 */
if( ! function_exists( 'hydrogen_portfolio_tinymce_post_types' ) ) {

	function hydrogen_portfolio_tinymce_post_types( $post_types ) {
		
		if( function_exists( 'youxi_portfolio_cpt_name' ) ) {
			if( ! is_array( $post_types ) ) {
				$post_types = array( $post_types );
			}
			$post_types[] = youxi_portfolio_cpt_name();
		}
		return $post_types;
	}
}
add_filter( 'youxi_builder_post_types', 'hydrogen_portfolio_tinymce_post_types' );
add_filter( 'youxi_shortcode_tinymce_post_types', 'hydrogen_portfolio_tinymce_post_types' );

/**
 * Portfolio Metaboxes
 */
if( ! function_exists( 'hydrogen_youxi_portfolio_cpt_metaboxes' ) ):

	function hydrogen_youxi_portfolio_cpt_metaboxes( $metaboxes ) {

		$metaboxes['general'] = array(
			'title' => __( 'General', 'youxi' ), 
			'fields' => array(
				'subtitle' => array(
					'type' => 'text', 
					'label' => __( 'Subtitle', 'youxi' ), 
					'description' => __( 'Enter here the portfolio subtitle.', 'youxi' ), 
					'show_admin_column' => true, 
					'std' => ''
				), 
				'url' => array(
					'type' => 'url', 
					'label' => __( 'URL', 'youxi' ), 
					'description' => __( 'Enter here the portfolio URL.', 'youxi' ), 
					'show_admin_column' => true, 
					'std' => ''
				), 
				'client' => array(
					'type' => 'text', 
					'label' => __( 'Client', 'youxi' ), 
					'description' => __( 'Enter here the portfolio client.', 'youxi' ), 
					'std' => ''
				), 
				'client_url' => array(
					'type' => 'text', 
					'label' => __( 'Client URL', 'youxi' ), 
					'description' => __( 'Enter here the portfolio client url.', 'youxi' ), 
					'std' => ''
				)
			)
		);

		$metaboxes['layout'] = array(
			'title' => __( 'Layout', 'youxi' ), 
			'fields' => array(
				'type' => array(
					'type' => 'select', 
					'label' => __( 'Portfolio Layout', 'youxi' ), 
					'description' => __( 'Choose the portfolio page layout.', 'youxi' ), 
					'choices' => array(
						'fullwidth' => __( 'Fullwidth', 'youxi' ), 
						'builder' => __( 'Page Builder', 'youxi' ), 
						'left_sidebar' => __( 'Left Sidebar', 'youxi' ), 
						'right_sidebar' => __( 'Right Sidebar', 'youxi' )
					), 
					'std' => 0
				), 
				'sidebar' => array(
					'type' => 'select', 
					'label' => __( 'Portfolio Sidebar Content', 'youxi' ), 
					'description' => __( 'Choose the portfolio page sidebar content.', 'youxi' ), 
					'choices' => array(
						'details' => __( 'Details', 'youxi' ), 
						'widget_area' => __( 'Widget Area', 'youxi' )
					), 
					'std' => 'details', 
					'criteria' => 'type:not(fullwidth),type:not(builder)'
				), 
				'sidebar_id' => array(
					'type' => 'select', 
					'label' => __( 'Widget Area', 'youxi' ), 
					'description' => __( 'Choose the widget area to display on the sidebar.', 'youxi' ), 
					'choices' => 'hydrogen_available_widget_areas', 
					'criteria' => 'type:not(fullwidth),type:not(builder),sidebar:is(widget_area)'
				), 
				'details' => array(
					'type' => 'repeater', 
					'label' => __( 'Details', 'youxi' ), 
					'description' => __( 'Specify the portfolio details to show on the sidebar.', 'youxi' ), 
					'fields' => array(
						'type' => array(
							'type' => 'select', 
							'label' => __( 'Detail Type', 'youxi' ), 
							'description' => __( 'Choose the portfolio detail type.', 'youxi' ), 
							'choices' => array(
								'categories' => __( 'Categories', 'youxi' ), 
								'url' => __( 'URL', 'youxi' ), 
								'client' => __( 'Client', 'youxi' ), 
								'custom' => __( 'Custom', 'youxi' )
							), 
							'std' => 'custom'
						), 
						'label' => array(
							'type' => 'text', 
							'label' => __( 'Label', 'youxi' ), 
							'description' => __( 'Enter the detail label.', 'youxi' ), 
							'std' => '', 
						), 
						'custom_value' => array(
							'type' => 'textarea', 
							'label' => __( 'Custom Value', 'youxi' ), 
							'description' => __( 'Enter the custom detail value.', 'youxi' ), 
							'std' => '', 
							'criteria' => 'type:is(custom)'
						)
					), 
					'min' => 0, 
					'preview_template' => '{{ data.label }}', 
					'std' => '', 
					'criteria' => 'type:not(fullwidth),type:not(builder),sidebar:is(details)'
				)
			)
		);

		$metaboxes['media'] = array(
			'title' => __( 'Media', 'youxi' ), 
			'fields' => array(
				'type' => array(
					'type' => 'select', 
					'label' => __( 'Media Type', 'youxi' ), 
					'description' => __( 'Choose the type of media to display.', 'youxi' ), 
					'choices' => array(
						0 => __( 'None', 'youxi' ), 
						'inline' => __( 'Inline Images', 'youxi' ), 
						'standard-slider' => __( 'Standard Slider', 'youxi' ), 
						'macbook-slider' => __( 'MacBook Slider', 'youxi' ), 
						'ipad-slider' => __( 'iPad Slider', 'youxi' ), 
						'iphone-slider' => __( 'iPhone Slider', 'youxi' ), 
						'nearby-slider' => __( 'Visible Nearby Slider', 'youxi' ), 
						'photoset' => __( 'Photoset', 'youxi' ), 
						'video' => __( 'Video', 'youxi' ), 
						'audio' => __( 'Audio', 'youxi' )
					), 
					'std' => 'inline'
				), 
				'images' => array(
					'type' => 'image', 
					'label' => __( 'Images', 'youxi' ), 
					'description' => __( 'Choose here the images to use.', 'youxi' ), 
					'multiple' => 'add', 
					'criteria' => 'type:not(0),type:not(video),type:not(audio)'
				), 
				'video_type' => array(
					'type' => 'select', 
					'label' => __( 'Video Type', 'youxi' ), 
					'description' => __( 'Choose here the video type.', 'youxi' ), 
					'choices' => array(
						'embed' => __( 'Embedded (YouTube/Vimeo)', 'youxi' ), 
						'hosted' => __( 'Hosted', 'youxi' )
					), 
					'std' => 'hosted', 
					'criteria' => 'type:is(video)'
				), 
				'video_embed' => array(
					'type' => 'textarea', 
					'label' => __( 'Video Embed Code (YouTube/Vimeo)', 'youxi' ), 
					'description' => __( 'Enter here the video embed code (YouTube/Vimeo).', 'youxi' ), 
					'std' => '', 
					'criteria' => 'type:is(video),video_type:is(embed)'
				), 
				'video_src' => array(
					'type' => 'upload', 
					'label' => __( 'Video Source', 'youxi' ), 
					'library_type' => 'video', 
					'description' => __( 'Choose here the hosted video source.', 'youxi' ), 
					'criteria' => 'type:is(video),video_type:is(hosted)'
				), 
				'video_poster' => array(
					'type' => 'image', 
					'multiple' => false, 
					'label' => __( 'Video Poster', 'youxi' ), 
					'description' => __( 'Upload here an image that will be used either as the poster or fallback for unsupported devices.', 'youxi' ), 
					'criteria' => 'type:is(video),video_type:is(hosted)'
				), 
				'audio_type' => array(
					'type' => 'select', 
					'label' => __( 'Audio Type', 'youxi' ), 
					'description' => __( 'Choose here the audio type.', 'youxi' ), 
					'choices' => array(
						'embed' => __( 'Embedded (SoundCloud)', 'youxi' ), 
						'hosted' => __( 'Hosted', 'youxi' )
					), 
					'std' => 'hosted', 
					'criteria' => 'type:is(audio)'
				), 
				'audio_embed' => array(
					'type' => 'textarea', 
					'label' => __( 'Embed Code (SoundCloud)', 'youxi' ), 
					'description' => __( 'Enter here the audio embed code (SoundCloud).', 'youxi' ), 
					'std' => '', 
					'criteria' => 'type:is(audio),audio_type:is(embed)'
				), 
				'audio_src' => array(
					'type' => 'upload', 
					'label' => __( 'Audio Source', 'youxi' ), 
					'library_type' => 'audio', 
					'description' => __( 'Choose here the hosted audio source.', 'youxi' ), 
					'criteria' => 'type:is(audio),audio_type:is(hosted)'
				)
			)
		);

		$metaboxes['style'] = array(
			'title' => __( 'Style', 'youxi' ), 
			'as_array' => false, 
			'fields' => array(
				'style' => array(
					'type' => 'select', 
					'label' => __( 'Portfolio Page Style', 'youxi' ), 
					'description' => __( 'Choose here a custom style for the portfolio page.', 'youxi' ), 
					'choices' => array( Youxi_Styles_Manager::get(), 'get_styles_list' ), 
					'std' => 0
				), 
				'custom_css' => array(
					'type' => 'code', 
					'label' => __( 'Custom CSS', 'youxi' ), 
					'description' => __( 'Enter here custom CSS code to add to the portfolio page.', 'youxi' ), 
					'mode' => 'css', 
					'std' => ''
				)
			)
		);

		return $metaboxes;
	}
endif;
add_filter( 'youxi_portfolio_cpt_metaboxes', 'hydrogen_youxi_portfolio_cpt_metaboxes' );

/* ==========================================================================
	Portfolio Shortcode
============================================================================= */

/**
 * Fetch all portfolio categories
 */
function hydrogen_portfolio_shortcode_categories() {
	$terms = get_terms( youxi_portfolio_tax_name(), array( 'fields' => 'id=>name', 'hide_empty' => false ) );
	if( ! is_wp_error( $terms ) ) {
		return $terms;
	}
	return array();
}

/**
 * Portfolio shortcode output
 */
if( ! function_exists( 'hydrogen_portfolio_shortcode_output' ) ):

	function hydrogen_portfolio_shortcode_output( $atts, $content, $tag ) {

		$template = locate_template( 'template-parts/portfolio/index.php' );
		if( '' !== $template ) {
			extract( array_merge( $atts, array( 'offset' => 0 ) ), EXTR_SKIP );
			include( $template );
		}
	}
endif;
add_action( 'youxi_portfolio_shortcode_output', 'hydrogen_portfolio_shortcode_output', 10, 3 );

/**
 * Portfolio shortcode styles
 */
if( ! function_exists( 'hydrogen_portfolio_shortcode_styles' ) ):

	function hydrogen_portfolio_shortcode_styles( $styles ) {
		return array_merge( $styles, hydrogen_get_styles( array( 'royalslider', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_portfolio_styles', 'hydrogen_portfolio_shortcode_styles' );

/**
 * Portfolio shortcode scripts
 */
if( ! function_exists( 'hydrogen_portfolio_shortcode_scripts' ) ):

	function hydrogen_portfolio_shortcode_scripts( $scripts ) {
		return array_merge( $scripts, hydrogen_get_scripts( array( 'hydrogen-project', 'royalslider', 'isotope', 'magnific-popup' ) ) );
	}
endif;
add_filter( 'youxi_shortcode_portfolio_scripts', 'hydrogen_portfolio_shortcode_scripts' );

/**
 * Portfolio shortcode attributes
 */
if( ! function_exists( 'hydrogen_portfolio_shortcode_atts' ) ):

	function hydrogen_portfolio_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'exclude' => array(
				'type' => 'checkboxlist', 
				'label' => __( 'Excluded Categories', 'youxi' ), 
				'description' => __( 'Choose the portfolio categories to exclude.', 'youxi' ), 
				'choices' => 'hydrogen_portfolio_shortcode_categories', 
				'serialize' => 'js:function( data ) {
					return ( data || [] ).join( "," );
				}', 
				'deserialize' => 'js:function( data ) {
					return ( data + "" ).split( "," )
				}'
			), 
			'show_filter' => array(
				'type' => 'switch', 
				'label' => __( 'Show Filter', 'youxi' ), 
				'description' => __( 'Switch to display the portfolio filter.', 'youxi' ), 
				'std' => true
			), 
			'show_title' => array(
				'type' => 'switch', 
				'label' => __( 'Show Title', 'youxi' ), 
				'description' => __( 'Switch to display the portfolio title below the image.', 'youxi' ), 
				'std' => true
			), 
			'ajax_loading' => array(
				'type' => 'switch', 
				'label' => __( 'Enable Ajax Loading', 'youxi' ), 
				'description' => __( 'Switch to enable AJAX loading of portfolio items. All items will be shown when disabled.', 'youxi' ), 
				'std' => true
			), 
			'posts_per_page' => array(
				'type' => 'uislider', 
				'label' => __( 'Number of Items', 'youxi' ), 
				'description' => __( 'Enter the number of items to show initially/on each AJAX request.', 'youxi' ), 
				'std' => 8, 
				'widgetopts' => array(
					'min' => 2, 
					'max' => 20
				), 
				'criteria' => 'ajax_loading:is(1)'
			), 
			'columns' => array(
				'type' => 'uislider', 
				'label' => __( 'Number of Columns', 'youxi' ), 
				'description' => __( 'Enter in how many columns should the portfolio items be displayed.', 'youxi' ), 
				'std' => 4, 
				'widgetopts' => array(
					'min' => 3, 
					'max' => 5
				)
			), 
			'orderby' => array(
				'type' => 'radio', 
				'label' => __( 'Order By', 'youxi' ), 
				'description' => __( 'Choose here how to order the portfolio items.', 'youxi' ), 
				'choices' => array(
					'post_date' => __( 'Post Date', 'youxi' ), 
					'menu_order' => __( 'Menu Order', 'youxi' ), 
					'title' => __( 'Alphabhetically', 'youxi' )
				), 
				'std' => 'post_date'
			), 
			'view_method' => array(
				'type' => 'radio', 
				'label' => __( 'View Method', 'youxi' ), 
				'description' => __( 'Choose here the method to view the portfolio details.', 'youxi' ), 
				'choices' => array(
					'ajax' => __( 'Ajax Popup', 'youxi' ), 
					'post' => __( 'Portfolio Page', 'youxi' ), 
					'url' => __( 'Portfolio URL', 'youxi' )
				), 
				'std' => 'ajax'
			), 
			'thumbnail_link' => array(
				'type' => 'select', 
				'label' => __( 'Thumbnails Link', 'youxi' ), 
				'description' => __( 'Choose how to show the portfolio link on thumbnails.', 'youxi' ), 
				'std' => 'buttons', 
				'choices' => array(
					'none' => __( 'None', 'youxi' ), 
					'direct' => __( 'Show Direct Link', 'youxi' ), 
					'buttons' => __( 'Show Zoom and Permalink Buttons', 'youxi' )
				)
			), 
			'thumbnail_size' => array(
				'type' => 'select', 
				'label' => __( 'Thumbnails Size', 'youxi' ), 
				'description' => __( 'Choose the portfolio thumbnails size.', 'youxi' ), 
				'std' => 'post-thumbnail', 
				'choices' => array(
					'post-thumbnail' => __( 'Post Thumbnail', 'youxi' ), 
					'portfolio_4by3' => __( 'Portfolio 4:3', 'youxi' ), 
					'portfolio_16by9' => __( 'Portfolio 16:9', 'youxi' ), 
					'portfolio_square' => __( 'Portfolio Square', 'youxi' )
				)
			)
		));
	}
endif;
add_filter( 'youxi_portfolio_shortcode_atts', 'hydrogen_portfolio_shortcode_atts' );
