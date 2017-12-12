<?php

// Make sure the plugin is active
if( ! defined( 'YOUXI_CORE_VERSION' ) ) {
	return;
}

/**
 * Add custom metaboxes to 'page'
 */
if( ! function_exists( 'youxi_add_page_metabox' ) ) {

	function youxi_add_page_metabox() {

		/* Get the 'metabox' settings */
		$metaboxes = array(

			'splash' => array(
				'title' => __( 'Splash', 'youxi' ), 
				'fields' => array(
					'type' => array(
						'type' => 'select', 
						'label' => __( 'Splash Type', 'youxi' ), 
						'description' => __( 'Choose here the splash type to be displayed at the top of the page.', 'youxi' ), 
						'choices' => array(
							0 => __( 'None', 'youxi' ), 
							'slider' => __( 'Hydrogen Slider', 'youxi' ), 
							'slider_with_bg' => __( 'Hydrogen Slider + Background', 'youxi' ), 
							'custom' => __( 'Custom Content', 'youxi' ), 
							'revslider' => __( 'Revolution Slider', 'youxi' )
						), 
						'std' => 0
					), 
					'height' => array(
						'type' => 'uislider', 
						'label' => __( 'Splash Height', 'youxi' ), 
						'description' => __( 'Specify here the height of the splash section in pixels. (0 for fullscreen height)', 'youxi' ), 
						'std' => 0, 
						'widgetopts' => array(
							'max' => 1600, 
							'step' => 10
						), 
						'criteria' => 'type:not(0),type:not(revslider)'
					), 
					'slider_content' => array(
						'type' => 'repeater', 
						'label' => __( 'Slider Content', 'youxi' ), 
						'description' => __( 'Enter here the content of the slider.', 'youxi' ), 
						'fieldsets' => array(
							'auto' => array(
								'id' => 'content', 
								'title' => __( 'Content', 'youxi' )
							), 
							'background' => array(
								'id' => 'background', 
								'title' => __( 'Background', 'youxi' )
							)
						), 
						'fields' => array(
							'intro_text' => array(
								'type' => 'text', 
								'label' => __( 'Intro Text', 'youxi' ), 
								'description' => __( 'Enter here the slide intro text.', 'youxi' )
							), 
							'intro_link' => array(
								'type' => 'url', 
								'label' => __( 'Intro Link URL', 'youxi' ), 
								'description' => __( 'Enter here the slide intro link URL.', 'youxi' )
							), 
							'intro_link_behavior' => array(
								'type' => 'select', 
								'label' => __( 'Intro Link Behavior', 'youxi' ), 
								'description' => __( 'Choose here the behavior of the intro link.', 'youxi' ), 
								'choices' => array(
									'default' => __( 'Default', 'youxi' ), 
									'image' => __( 'Image Popup', 'youxi' ), 
									'iframe' => __( 'Iframe Popup (YouTube/Vimeo/Google Maps)', 'youxi' )
								), 
								'std' => 'default'
							), 
							'headline' => array(
								'type' => 'textarea', 
								'label' => __( 'Headline', 'youxi' ), 
								'description' => __( 'Enter here the slide headline.', 'youxi' )
							), 
							'description' => array(
								'type' => 'textarea', 
								'label' => __( 'Description', 'youxi' ), 
								'description' => __( 'Enter here the slide description.', 'youxi' )
							), 
							'background' => array(
								'type' => 'image', 
								'label' => __( 'Background Image', 'youxi' ), 
								'description' => __( 'Upload here the slide background image.', 'youxi' ), 
								'multiple' => false, 
								'fieldset' => 'background'
							), 
							'background_mode' => array(
								'type' => 'select', 
								'label' => __( 'Mode', 'youxi' ), 
								'description' => __( 'Choose here the slide background mode.', 'youxi' ), 
								'choices' => array(
									'none' => __( 'None', 'youxi' ), 
									'fixed' => __( 'Fixed', 'youxi' ), 
									'parallax' => __( 'Parallax', 'youxi' )
								), 
								'std' => 'parallax', 
								'fieldset' => 'background'
							), 
							'background_parallax_speed' => array(
								'type' => 'uislider', 
								'label' => __( 'Speed', 'youxi' ), 
								'description' => __( 'Specify here the slide background parallax speed.', 'youxi' ), 
								'widgetopts' => array(
									'min' => 0, 
									'max' => 1, 
									'step' => 0.1
								), 
								'std' => 0.3, 
								'criteria' => 'background_mode:is(parallax)', 
								'fieldset' => 'background'
							)
						), 
						'min' => 0, 
						'preview_template' => '{{ data.intro_text }}', 
						'std' => array(), 
						'criteria' => array(
							'operator' => 'or', 
							'condition' => 'type:is(slider),type:is(slider_with_bg)'
						)
					), 
					'slider_duration' => array(
						'type' => 'uislider', 
						'label' => __( 'Slider Duration', 'youxi' ), 
						'description' => __( 'Specify here the duration before each slide advance to the next slide.', 'youxi' ), 
						'widgetopts' => array(
							'min' => 1000, 
							'max' => 10000, 
							'step' => 100
						), 
						'std' => 4000, 
						'criteria' => array(
							'operator' => 'or', 
							'condition' => 'type:is(slider),type:is(slider_with_bg)'
						)
					), 
					'slider_bg' => array(
						'type' => 'select', 
						'label' => __( 'Slider Background', 'youxi' ), 
						'description' => __( 'Choose here the slider background type.', 'youxi' ), 
						'choices' => array(
							0 => __( 'None', 'youxi' ), 
							'img' => __( 'Parallax Background', 'youxi' ), 
							'video' => __( 'Video', 'youxi' )
						), 
						'std' => 0, 
						'criteria' => 'type:is(slider_with_bg)'
					), 
					'slider_bg_img' => array(
						'type' => 'image', 
						'label' => __( 'Slider Background Image', 'youxi' ), 
						'description' => __( 'Upload here the background image file.', 'youxi' ), 
						'multiple' => false, 
						'criteria' => 'type:is(slider_with_bg),slider_bg:is(img)'
					), 
					'slider_bg_img_mode' => array(
						'type' => 'select', 
						'label' => __( 'Slider Background Image Mode', 'youxi' ), 
						'description' => __( 'Choose here the background mode.', 'youxi' ), 
						'choices' => array(
							'none' => __( 'None', 'youxi' ), 
							'fixed' => __( 'Fixed', 'youxi' ), 
							'parallax' => __( 'Parallax', 'youxi' )
						), 
						'std' => 'parallax', 
						'criteria' => 'type:is(slider_with_bg),slider_bg:is(img)'
					), 
					'slider_bg_img_parallax_speed' => array(
						'type' => 'uislider', 
						'label' => __( 'Slider Background Image Parallax Speed', 'youxi' ), 
						'description' => __( 'Specify here the background parallax speed.', 'youxi' ), 
						'widgetopts' => array(
							'min' => 0, 
							'max' => 1, 
							'step' => 0.1
						), 
						'std' => 0.3, 
						'criteria' => 'type:is(slider_with_bg),slider_bg:is(img),slider_bg_img_mode:is(parallax)'
					), 
					'slider_bg_video_src' => array(
						'type' => 'upload', 
						'label' => __( 'Slider Background Video Source', 'youxi' ), 
						'library_type' => 'video', 
						'description' => __( 'Choose here the hosted video source.', 'youxi' ), 
						'criteria' => 'type:is(slider_with_bg),slider_bg:is(video)'
					), 
					'slider_bg_video_poster' => array(
						'type' => 'image', 
						'multiple' => false, 
						'label' => __( 'Slider Background Video Poster', 'youxi' ), 
						'description' => __( 'Upload here an image that will be used either as the poster or fallback for unsupported devices.', 'youxi' ), 
						'criteria' => 'type:is(slider_with_bg),slider_bg:is(video)'
					), 
					'revslider_id' => array(
						'type' => 'text', 
						'label' => __( 'Revolution Slider ID/Slug', 'youxi' ), 
						'description' => __( 'Enter here your Revolution Slider ID/Slug. Make sure Revolution Slider is installed and activated.', 'youxi' ), 
						'std' => '', 
						'criteria' => 'type:is(revslider)'
					), 
					'custom_content' => array(
						'type' => 'textarea', 
						'label' => __( 'Custom Content', 'youxi' ), 
						'description' => __( 'Enter here the custom splash content.', 'youxi' ), 
						'criteria' => 'type:is(custom)'
					), 
					'feedback_text' => array(
						'type' => 'text', 
						'label' => __( 'Feedback Text', 'youxi' ), 
						'description' => __( 'Enter here the feedback text. Leave empty to hide.', 'youxi' ), 
						'std' => '', 
						'criteria' => 'type:not(0),type:not(revslider),type:not(custom)'
					)
				)
			), 

			'title' => array(

				'title' => __( 'Title', 'youxi' ), 

				'fields' => array(
					'visible' => array(
						'type' => 'switch', 
						'label' => __( 'Show Title', 'youxi' ), 
						'description' => __( 'Switch to display the page\'s title and subtitle.', 'youxi' ), 
						'std' => false
					), 
					'alignment' => array(
						'type' => 'select', 
						'label' => __( 'Title Alignment', 'youxi' ), 
						'description' => __( 'Choose here the page\'s title text alignment.', 'youxi' ), 
						'choices' => array(
							'left' => __( 'Left', 'youxi' ), 
							'center' => __( 'Center', 'youxi' ), 
							'right' => __( 'Right', 'youxi' )
						), 
						'std' => 'center', 
						'criteria' => 'visible:is(1)'
					), 
					'subtitle' => array(
						'type' => 'text', 
						'label' => __( 'Subtitle', 'youxi' ), 
						'description' => __( 'Type here the page\'s subtitle.', 'youxi' ), 
						'std' => '', 
						'criteria' => 'visible:is(1)'
					), 
					'padding_top' => array(
						'type' => 'select', 
						'label' => __( 'Title Padding Top', 'youxi' ), 
						'description' => __( 'Choose here the page\'s title area top padding size.', 'youxi' ), 
						'choices' => array(
							'no' => __( 'None', 'youxi' ), 
							'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
							'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
							'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
							'full' => __( 'Full (140px at Maximum)', 'youxi' )
						), 
						'std' => 'full', 
						'criteria' => 'visible:is(1)'
					), 
					'padding_bottom' => array(
						'type' => 'select', 
						'label' => __( 'Title Padding Bottom', 'youxi' ), 
						'description' => __( 'Choose here the page\'s title area bottom padding size.', 'youxi' ), 
						'choices' => array(
							'no' => __( 'None', 'youxi' ), 
							'quarter' => __( 'Quarter (35px at Maximum)', 'youxi' ), 
							'half' => __( 'Half (70px at Maximum)', 'youxi' ), 
							'three-quarters' => __( 'Three Quarters (105px at Maximum)', 'youxi' ), 
							'full' => __( 'Full (140px at Maximum)', 'youxi' )
						), 
						'std' => 'three-quarters', 
						'criteria' => 'visible:is(1)'
					)
				)
			), 

			'layout' => array(

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
						'description' => __( 'Choose here the page\'s content area top padding size.', 'youxi' ), 
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
						'description' => __( 'Choose here the page\'s content area bottom padding size.', 'youxi' ), 
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
			),

			'style' => array(
				'title' => __( 'Style', 'youxi' ), 
				'as_array' => false, 
				'fields' => array(
					'style' => array(
						'type' => 'select', 
						'label' => __( 'Page Style', 'youxi' ), 
						'description' => __( 'Choose here a custom style for this page.', 'youxi' ), 
						'choices' => array( Youxi_Styles_Manager::get(), 'get_styles_list' ), 
						'std' => 0
					), 
					'custom_css' => array(
						'type' => 'code', 
						'label' => __( 'Custom CSS', 'youxi' ), 
						'description' => __( 'Enter here your custom CSS code to add to this page.', 'youxi' ), 
						'mode' => 'css', 
						'std' => ''
					)
				)
			)
		);

		/* Create the 'page' post type object */
		$post_type_object = Youxi_Post_Type::get( 'page' );

		/* Add the metaboxes */
		foreach( $metaboxes as $metabox_id => $metabox ) {
			$post_type_object->add_meta_box( new Youxi_Metabox( $metabox_id, $metabox ) );
		}
	}
}
add_action( 'init', 'youxi_add_page_metabox' );

/**
 * Add custom metaboxes to 'post'
 */
if( ! function_exists( 'youxi_add_post_metabox' ) ) {

	function youxi_add_post_metabox() {

		/* Get the 'metabox' settings */
		$metaboxes = array(

			'style' => array(
				'title' => __( 'Style', 'youxi' ), 
				'as_array' => false, 
				'fields' => array(
					'style' => array(
						'type' => 'select', 
						'label' => __( 'Post Page Style', 'youxi' ), 
						'description' => __( 'Choose here a custom style for the post page.', 'youxi' ), 
						'choices' => array( Youxi_Styles_Manager::get(), 'get_styles_list' ), 
						'std' => 0
					), 
					'custom_css' => array(
						'type' => 'code', 
						'label' => __( 'Custom CSS', 'youxi' ), 
						'description' => __( 'Enter here your custom CSS code to add to this post.', 'youxi' ), 
						'mode' => 'css', 
						'std' => ''
					)
				)
			)
		);

		/* Create the `post` post type wrapper object */
		$post_type_object = Youxi_Post_Type::get( 'post' );

		/* Add the metaboxes */
		foreach( $metaboxes as $metabox_id => $metabox ) {
			$post_type_object->add_meta_box( new Youxi_Metabox( $metabox_id, $metabox ) );
		}
	}
}
add_action( 'init', 'youxi_add_post_metabox' );
