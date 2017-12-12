<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_ONE_PAGER_VERSION' ) ) {
	return;
}

/**
 * Add the tinymce and page builder to one page blocks
 */
if( ! function_exists( 'hydrogen_builder_tinymce_post_types' ) ):

	function hydrogen_builder_tinymce_post_types( $post_types ) {
		
		if( class_exists( 'Youxi_One_Pager' ) ) {
			if( ! is_array( $post_types ) ) {
				$post_types = array( $post_types );
			}
			$post_types[] = Youxi_One_Pager::post_type_name();
		}
		return $post_types;
	}
endif;
add_filter( 'youxi_builder_post_types', 'hydrogen_builder_tinymce_post_types' );
add_filter( 'youxi_shortcode_tinymce_post_types', 'hydrogen_builder_tinymce_post_types' );

/**
 * Filter the valid menu location for nav walker
 */
if( ! function_exists( 'hydrogen_one_pager_override_nav_walker' ) ):

function hydrogen_one_pager_override_nav_walker( $valid_locations ) {

	if( is_array( $valid_locations ) ) {
		$valid_locations[] = 'main-menu';
	}

	return $valid_locations;
}
endif;
add_filter( 'youxi_one_pager_override_nav_walker', 'hydrogen_one_pager_override_nav_walker' );

/**
 * Adjust page block CPT metaboxes
 */
if( ! function_exists( 'hydrogen_one_pager_cpt_metaboxes' ) ):

function hydrogen_one_pager_cpt_metaboxes( $metaboxes ) {

	$metaboxes['title'] = array(
		'title' => __( 'Title', 'youxi' ), 
		'fields' => array(
			'visible' => array(
				'type' => 'switch', 
				'label' => __( 'Show Title', 'youxi' ), 
				'description' => __( 'Switch to display the title. If using the page builder, the title will be visible only if you have at least one container element.', 'youxi' ), 
				'std' => true
			), 
			'element' => array(
				'type' => 'select', 
				'label' => __( 'Element', 'youxi' ), 
				'description' => __( 'Choose here the HTML element to use for the title.', 'youxi' ), 
				'choices' => array(
					'h1' => 'H1', 
					'h2' => 'H2', 
					'h3' => 'H3', 
					'h4' => 'H4', 
					'h5' => 'H5', 
					'h6' => 'H6'
				), 
				'std' => 'h1', 
				'criteria' => 'visible:is(1)'
			), 
			'subtitle' => array(
				'type' => 'text', 
				'label' => __( 'Subtitle', 'youxi' ), 
				'description' => __( 'Type here the subtitle.', 'youxi' ), 
				'std' => '', 
				'criteria' => 'visible:is(1)'
			), 
			'highlight_subtitle' => array(
				'type' => 'switch', 
				'label' => __( 'Highlight Subtitle', 'youxi' ), 
				'description' => __( 'Switch to highlight the subtitle.', 'youxi' ), 
				'std' => false, 
				'criteria' => 'visible:is(1)'
			), 
			'layout' => array(
				'type' => 'select', 
				'label' => __( 'Layout', 'youxi' ), 
				'description' => __( 'Choose here the layout. The title will be attached on the first container in this page block.', 'youxi' ), 
				'choices' => array(
					'fullwidth' => __( 'Fullwidth', 'youxi' ), 
					'align_left' => __( 'Left Aligned', 'youxi' ), 
					'align_right' => __( 'Right Aligned', 'youxi' ), 
					'subtitle' => __( 'Subtitle', 'youxi' )
				), 
				'std' => 'fullwidth', 
				'criteria' => 'visible:is(1)'
			), 
			'alignment' => array(
				'type' => 'radio', 
				'label' => __( 'Alignment', 'youxi' ), 
				'description' => __( 'Choose here the title alignment.', 'youxi' ), 
				'choices' => array(
					'left' => __( 'Left', 'youxi' ), 
					'center' => __( 'Center', 'youxi' ), 
					'right' => __( 'Right', 'youxi' )
				), 
				'std' => 'left', 
				'criteria' => 'visible:is(1),layout:is(subtitle)'
			), 
			'show_counter' => array(
				'type' => 'switch', 
				'label' => __( 'Show Counter', 'youxi' ), 
				'description' => __( 'Switch to display a counter above the title.', 'youxi' ), 
				'std' => true, 
				'criteria' => 'visible:is(1),layout:not(subtitle)'
			), 
			'col_type' => array(
				'type' => 'select', 
				'label' => __( 'Column Type', 'youxi' ), 
				'description' => __( 'Choose here the title column type.', 'youxi' ), 
				'choices' => array(
					'xs' => 'col-xs-*', 
					'sm' => 'col-sm-*', 
					'md' => 'col-md-*', 
					'lg' => 'col-lg-*'
				), 
				'std' => 'lg', 
				'criteria' => 'visible:is(1),layout:not(fullwidth),layout:not(subtitle)'
			), 
			'title_size' => array(
				'type' => 'uislider', 
				'label' => __( 'Title Size', 'youxi' ), 
				'description' => __( 'Choose here the title column size.', 'youxi' ), 
				'std' => 3, 
				'widgetopts' => array(
					'min' => 1, 
					'max' => 12, 
					'step' => 1
				), 
				'criteria' => 'visible:is(1),layout:not(fullwidth),layout:not(subtitle)'
			), 
			'content_size' => array(
				'type' => 'uislider', 
				'label' => __( 'Content Size', 'youxi' ), 
				'description' => __( 'Choose here the content column size.', 'youxi' ), 
				'std' => 9, 
				'widgetopts' => array(
					'min' => 1, 
					'max' => 12, 
					'step' => 1
				), 
				'criteria' => 'visible:is(1),layout:not(fullwidth),layout:not(subtitle)'
			), 
			'gap_size' => array(
				'type' => 'uislider', 
				'label' => __( 'Gap Size', 'youxi' ), 
				'description' => __( 'Choose here the gap size between columns.', 'youxi' ), 
				'std' => 0, 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 12, 
					'step' => 1
				), 
				'criteria' => 'visible:is(1),layout:not(fullwidth),layout:not(subtitle)'
			)
		)
	);

	$metaboxes['layout'] = array(

		'title' => __( 'Layout', 'youxi' ), 

		'fields' => array(
			'use_builder' => array(
				'type' => 'switch', 
				'label' => __( 'Use Builder', 'youxi' ), 
				'description' => __( 'Switch ON when using the page builder, otherwise content will be messed up.', 'youxi' ), 
				'std' => true
			), 
			'padding_top' => array(
				'type' => 'select', 
				'label' => __( 'Padding Top', 'youxi' ), 
				'description' => __( 'Choose here the page block\'s content area top padding size.', 'youxi' ), 
				'choices' => array(
					'no' => __( 'None', 'youxi' ), 
					'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
					'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
					'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
					'full' => __( 'Full (140px at Maximum)', 'youxi' )
				), 
				'std' => 'full', 
				'criteria' => 'use_builder:is(0)'
			), 
			'padding_bottom' => array(
				'type' => 'select', 
				'label' => __( 'Padding Bottom', 'youxi' ), 
				'description' => __( 'Choose here the page block\'s content area bottom padding size.', 'youxi' ), 
				'choices' => array(
					'no' => __( 'None', 'youxi' ), 
					'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
					'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
					'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
					'full' => __( 'Full (140px at Maximum)', 'youxi' )
				), 
				'std' => 'three-quarters', 
				'criteria' => 'use_builder:is(0)'
			)
		)
	);

	$metaboxes['style'] = array(
		'title' => __( 'Style', 'youxi' ), 
		'as_array' => false, 
		'fields' => array(
			'style' => array(
				'type' => 'select', 
				'label' => __( 'Page Block Style', 'youxi' ), 
				'description' => __( 'Choose here a custom style for this page block.', 'youxi' ), 
				'choices' => array( Youxi_Styles_Manager::get(), 'get_styles_list' ), 
				'std' => 0
			)
		)
	);

	$metaboxes['bg_media'] = array(
		'title' => __( 'Background Media', 'youxi' ), 
		'fields' => array(
			'type' => array(
				'type' => 'select', 
				'label' => __( 'Type', 'youxi' ), 
				'description' => __( 'Choose here the background media type.', 'youxi' ), 
				'choices' => array(
					0 => __( 'None', 'youxi' ), 
					'img' => __( 'Parallax Background', 'youxi' ), 
					'video' => __( 'Video', 'youxi' )
				), 
				'std' => 0
			), 
			'image' => array(
				'type' => 'image', 
				'label' => __( 'Image', 'youxi' ), 
				'description' => __( 'Upload here the backgrond image file.', 'youxi' ), 
				'multiple' => false, 
				'criteria' => 'enable:is(1),type:is(img)'
			), 
			'image_mode' => array(
				'type' => 'select', 
				'label' => __( 'Image Mode', 'youxi' ), 
				'description' => __( 'Choose here the background image mode.', 'youxi' ), 
				'choices' => array(
					'none' => __( 'None', 'youxi' ), 
					'fixed' => __( 'Fixed', 'youxi' ), 
					'parallax' => __( 'Parallax', 'youxi' )
				), 
				'std' => 'parallax', 
				'criteria' => 'enable:is(1),type:is(img)'
			), 
			'image_parallax_speed' => array(
				'type' => 'uislider', 
				'label' => __( 'Image Parallax Speed', 'youxi' ), 
				'description' => __( 'Specify here the background image parallax speed.', 'youxi' ), 
				'widgetopts' => array(
					'min' => 0, 
					'max' => 1, 
					'step' => 0.1
				), 
				'std' => 0.3, 
				'criteria' => 'enable:is(1),type:is(img),image_mode:is(parallax)'
			), 
			'video_src' => array(
				'type' => 'upload', 
				'label' => __( 'Video Source', 'youxi' ), 
				'library_type' => 'video', 
				'description' => __( 'Choose here the hosted video source.', 'youxi' ), 
				'criteria' => 'enable:is(1),type:is(video)'
			), 
			'video_poster' => array(
				'type' => 'image', 
				'multiple' => false, 
				'label' => __( 'Video Poster', 'youxi' ), 
				'description' => __( 'Upload here an image that will be used either as the poster or fallback for unsupported devices.', 'youxi' ), 
				'criteria' => 'enable:is(1),type:is(video),video_type:is(hosted)'
			)
		)
	);

	return $metaboxes;
}
endif;
add_filter( 'youxi_one_pager_cpt_metaboxes', 'hydrogen_one_pager_cpt_metaboxes' );

/**
 * Filter Page Block Choices for WPML
 */
if( ! function_exists( 'youxi_one_pager_wpml_filter' ) ):

function youxi_one_pager_wpml_filter( $page_blocks ) {

	global $sitepress;
	if( is_a( $sitepress, 'SitePress' ) ) {

		$default_lang = $sitepress->get_default_language();
		$icl_el_name = 'post_' . Youxi_One_Pager::post_type_name();

		foreach( array_keys( $page_blocks ) as $post_id ) {
			$post_lang = $sitepress->get_language_for_element( $post_id, $icl_el_name );

			/* If the post is in the default language */
			if( $post_lang == $default_lang ) {
				$object_id = icl_object_id( $post_id, Youxi_One_Pager::post_type_name(), false );
				if( ! is_null( $object_id ) && ( $post = get_post( $object_id ) ) && 'publish' == get_post_status( $object_id ) ) {
					$page_blocks[ $post_id ] = $post->post_title;
				} else {
					$page_blocks[ $post_id ] = sprintf( __( '%s (no translation - hidden)', 'youxi' ), $page_blocks[ $post_id ] );
				}
			} else {
				unset( $page_blocks[ $post_id ] );
			}
		}
	}

	return $page_blocks;
}
endif;
add_filter( 'youxi_one_pager_block_choices', 'youxi_one_pager_wpml_filter' );
