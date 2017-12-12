<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Text Domain
============================================================================= */

if( ! function_exists( 'hydrogen_load_theme_textdomain' ) ):

function hydrogen_load_theme_textdomain() {
	load_theme_textdomain( 'youxi', get_template_directory() . '/languages' );
}
endif;
add_action( 'after_setup_theme', 'hydrogen_load_theme_textdomain' );

/* ==========================================================================
	Theme Support
============================================================================= */

if( ! function_exists( 'hydrogen_add_theme_support' ) ):

function hydrogen_add_theme_support() {

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'gallery' ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
}
endif;
add_action( 'init', 'hydrogen_add_theme_support' );

/* ==========================================================================
	Pre WordPress 4.1 <title>
============================================================================= */

if( ! function_exists( '_wp_render_title_tag' ) ):

function hydrogen_render_title() {
	echo '<title>' . wp_title( '|', false, 'right' ) . '</title>' . PHP_EOL;
}
add_action( 'wp_head', 'hydrogen_render_title' );

function hydrogen_wp_title( $title, $sep ) {
	global $page, $paged;

	if( empty( $title ) && ! is_feed() ) {
		$title .= get_bloginfo( 'name', 'display' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'hydrogen' ), max( $paged, $page ) );
		}
	}

	return $title;
}
add_filter( 'wp_title', 'hydrogen_wp_title', 10, 2 );
endif;

/* ==========================================================================
	Image Sizes
============================================================================= */

if( ! function_exists( 'hydrogen_add_image_sizes' ) ):

function hydrogen_add_image_sizes() {

	$image_sizes = apply_filters( 'hydrogen_wp_image_sizes', array() );

	foreach( $image_sizes as $name => $size ) {

		/* Skip reserved names */
		if( preg_match( '/^((post-)?thumbnail|thumb|medium|large)$/', $name ) ) {
			continue;
		}

		$size = wp_parse_args( $size, array(
			'width'  => 0, 
			'height' => 0, 
			'crop'   => false
		));
		add_image_size( $name, $size['width'], $size['height'], $size['crop'] );
	}
}
endif;
add_action( 'init', 'hydrogen_add_image_sizes' );

/* ==========================================================================
	Image Size Names
============================================================================= */

if( ! function_exists( 'hydrogen_image_size_names' ) ):

function hydrogen_image_size_names( $names ) {

	$image_sizes = apply_filters( 'hydrogen_wp_image_sizes', array() );

	foreach( $image_sizes as $name => $size ) {

		/* Skip reserved names */
		if( preg_match( '/^((post-)?thumbnail|thumb|medium|large)$/', $name ) ) {
			continue;
		}

		if( isset( $size['label'] ) && '' != $size['label'] ) {
			$names[ $name ] = $size['label'];
		}
	}

	return $names;
}
endif;
add_filter( 'image_size_names_choose', 'hydrogen_image_size_names' );

/* ==========================================================================
	Nav Menus
============================================================================= */

if( ! function_exists( 'hydrogen_register_nav_menus' ) ):

function hydrogen_register_nav_menus() {

	$nav_menus = array( 'main-menu' => __( 'Main Menu', 'youxi' ) );
	register_nav_menus( $nav_menus );
}
endif;
add_action( 'init', 'hydrogen_register_nav_menus' );

/* ==========================================================================
	Widgets
============================================================================= */

if( ! function_exists( 'hydrogen_widgets_init' ) ):

function hydrogen_widgets_init() {

	// Register custom user sidebars
	if( $user_sidebars = ot_get_option( 'user_sidebars' ) ) {

		foreach( $user_sidebars as $index => $sidebar ) {

			register_sidebar( array(
				'name'          => $sidebar['title'], 
				'id'            => sanitize_key( 'custom-' . $sidebar['title'] ), 
				'description'   => $sidebar['description'], 
				'before_widget' => '<div id="%1$s" class="sidebar-block widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="sidebar-title">',
				'after_title'   => '</h4>'
			));
		}
	}

	// Register footer widget area
	if( 'logo' != ot_get_option( 'footer_layout' ) ) {

		for( $i = 1, $j = ot_get_option( 'footer_widgets_cols' ); $i <= $j; $i++ ) {

			register_sidebar(array(
				'name' => sprintf( __( 'Footer Widget Area %d', 'youxi' ), $i ), 
				'id' => "footer_widget_area_{$i}", 
				'description' => sprintf( __( 'This is footer widget area #%d', 'youxi' ), $i ), 
				'before_widget' => '<div id="%1$s" class="widget %2$s col-md-' . ( 12 / $j ) . '">',
				'after_widget' => '</div>', 
				'before_title' => '<h5 class="widget-title">', 
				'after_title' => '</h5>'
			));

		}
	}
}
endif;
add_action( 'widgets_init', 'hydrogen_widgets_init' );

/* ==========================================================================
	Other WP Filters
============================================================================= */

if( ! function_exists( 'hydrogen_body_class' ) ):

function hydrogen_body_class( $classes ) {
	if( preg_match( '/^(top|bottom)_fixed$/', ot_get_option( 'header_layout' ) ) ) {
		$classes[] = 'header-' . str_replace( '_', '-', ot_get_option( 'header_layout' ) );
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'hydrogen_body_class' );

/**
 * Hook to shortcode output filter to dequeue wp mediaelement style
 */
if( ! function_exists( 'hydrogen_wp_media_shortcode' ) ):

function hydrogen_wp_media_shortcode( $html ) {

	/* Dequeue default wp mediaelement style */
	if( wp_style_is( 'wp-mediaelement', 'enqueued' ) ) {
		wp_dequeue_style( 'wp-mediaelement' );
	}
	return $html;
}
endif;
add_filter( 'wp_video_shortcode', 'hydrogen_wp_media_shortcode' );
add_filter( 'wp_audio_shortcode', 'hydrogen_wp_media_shortcode' );

/**
 * Filter `wp_title` to fix empty titles on static front page
 */
if( ! function_exists( 'hydrogen_wp_title' ) ):

function hydrogen_wp_title( $title ) {

	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	}

	return $title;
}
endif;
add_filter( 'wp_title', 'hydrogen_wp_title' );

/* ==========================================================================
	Scripts and Styles
============================================================================= */

/**
 * Register theme styles
 */
if( ! function_exists( 'hydrogen_register_styles' ) ):

function hydrogen_register_styles() {

	if( class_exists( 'Youxi_Styles_Manager' ) ) {
		
		$primary_targets = array(
			'module-hover-bg' => '@brand-primary', 
			'section-title-stripe-bg' => '@brand-primary', 
			'icon-box-icon-color' => '@brand-primary', 
			'icon-box-icon-hover-bg' => '@brand-primary', 
			'team-popup-link-bg' => '@brand-primary', 
			'counter-digit-color' => '@brand-primary', 
			'testimonial-slider-icon-bg' => '@brand-primary', 
			'tweet-slider-icon-bg' => '@brand-primary', 
			'recent-post-read-link-bg' => '@brand-primary', 
			'project-filter-hover-bg' => '@brand-primary', 
			'project-action-links-bg' => '@brand-primary', 
			'project-load-hover-bg' => '@brand-primary', 
			'media-link-hover-bg' => '@brand-primary'
		);

		/* Get styles manager instance */
		$styles_manager = Youxi_Styles_Manager::get();

		/* Register Default Styles (Light and Dark) */
		$styles_manager
			->register_style( 'light', __( 'Light', 'youxi' ), hydrogen_style_light() )
			->register_style( 'dark', __( 'Dark', 'youxi' ), hydrogen_style_dark() );

		/* Register User Defined Styles */
		if( $custom_styles = ot_get_option( 'custom_styles' ) ) {
			foreach( (array) $custom_styles as $style ) {

				if( ! isset( $style['title'] ) || '' == $style['title'] ) {
					continue;
				}

				$title = $style['title'];
				unset( $style['title'] );

				$vars = array();
				foreach( $style as $var => $value ) {
					$vars[ str_replace( '_', '-', $var ) ] = $value;
				}
				$vars = array_merge( $vars, $primary_targets );
				$styles_manager->register_style( sanitize_key( $title ), $title, $vars );
			}
		}
	}
}
endif;
add_action( 'after_setup_theme', 'hydrogen_register_styles' );

/**
 * Add Favicon
 */
if( ! function_exists( 'hydrogen_add_favicon' ) ):

function hydrogen_add_favicon() {
	$favicon = ot_get_option( 'favicon' );
	if( $favicon ): ?>
	<link rel="shortcut icon" href="<?php echo $favicon ?>">
	<?php endif;
}
endif;
add_action( 'wp_head', 'hydrogen_add_favicon' );

/**
 * Hydrogen 'stylesheet_uri'
 */
if( ! function_exists( 'hydrogen_stylesheet_uri' ) ):

function hydrogen_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {

	if( ! is_child_theme() ) {
		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return $stylesheet_dir_uri . "/assets/css/style.css";
		}
		return $stylesheet_dir_uri . "/assets/css/style.min.css";
	}

	return $stylesheet_uri;	
}
endif;
add_filter( 'stylesheet_uri', 'hydrogen_stylesheet_uri', 10, 2 );

/**
 * Hydrogen 'wp_enqueue_scripts' hook
 */
if( ! function_exists( 'hydrogen_wp_enqueue_script' ) ):

function hydrogen_wp_enqueue_script( $hook ) {

	global $post;
	
	$wp_theme = wp_get_theme();
	$theme_version = $wp_theme->exists() ? $wp_theme->get( 'Version' ) : false;

	$typography_manager = Hydrogen_Typography_Manager::get();
	$styles_manager     = Youxi_Styles_Manager::get();

	$script_debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	$suffix = $script_debug ? '' : '.min';

	/* Register Core Styles */
	wp_register_style( 'bootstrap', get_template_directory_uri() . "/assets/bootstrap/css/bootstrap{$suffix}.css", array(), '3.3.4', 'screen' );
	wp_register_style( 'hydrogen', get_stylesheet_uri(), array( 'bootstrap' ), $theme_version, 'screen' );

	/* Register Fonts */
	$font_styles = $typography_manager->get_styles();
	foreach( $font_styles as $handle => $args ) {
		wp_register_style( $handle, $args['src'], $args['deps'], $args['ver'], $args['media'] );
	}

	/* Register Icons */
	wp_register_style( 'font-icons', get_template_directory_uri() . "/assets/icons/style.css", array(), $theme_version, 'screen' );

	/* Register Plugin Styles */
	wp_register_style( 'magnific-popup', get_template_directory_uri() . "/assets/plugins/mfp/jquery.mfp.css", array(), '1.0.0', 'screen' );
	wp_register_style( 'royalslider', get_template_directory_uri() . "/assets/plugins/royalslider/royalslider{$suffix}.css", array(), '1.0.5', 'screen' );

	/* Enqueue Fonts */
	array_map( 'wp_enqueue_style', array_keys( $font_styles ) );

	/* Enqueue Icons */
	wp_enqueue_style( 'font-icons' );

	/* Enqueue Core Styles */
	wp_enqueue_style( 'hydrogen' );

	/* Make sure the LESS compiler exists */
	if( ! class_exists( 'Youxi_LESS_Compiler' ) ) {
		require( get_template_directory() . '/lib/framework/class-less-compiler.php' );
	}
	$less_compiler = Youxi_LESS_Compiler::get();

	/* Get the accent color setting */
	$brand_primary = ot_get_option( 'accent_color', hydrogen_default_accent_color() );

	/* Custom fonts styles */
	wp_add_inline_style( 'hydrogen', $less_compiler->compile( '/assets/less/fonts.less', $typography_manager->get_less_vars() ) );

	/* Custom accent color styles */
	if( hydrogen_default_accent_color() !== $brand_primary ) {
		wp_add_inline_style( 'bootstrap', $less_compiler->compile( '/assets/less/overrides/bootstrap.less', array( 'bs-override' => array( 'brand-primary' => $brand_primary ) ) ) );
		wp_add_inline_style( 'hydrogen', $less_compiler->compile( '/assets/less/overrides/core.less', array( 'core-override' => array( 'brand-primary' => $brand_primary ) ) ) );
	}

	/* Custom theme styles */
	wp_add_inline_style( 'hydrogen', $less_compiler->compile( '/assets/less/theme.less', $styles_manager->get_less_vars() ) );

	/* Custom user styles */
	wp_add_inline_style( 'hydrogen', ot_get_option( 'custom_css' ) );

	/* Custom per page styles */
	if( is_a( $post, 'WP_Post' ) && in_array( $post->post_type, array( 'post', 'page', 'portfolio' ) ) ) {
		if( ! empty( $post->custom_css ) ) {
			wp_add_inline_style( 'hydrogen', $post->custom_css );
		}
	}

	/* Register core scripts */
	wp_register_script( 'bootstrap', get_template_directory_uri() . "/assets/bootstrap/js/bootstrap{$suffix}.js", array( 'jquery' ), '3.3.4', true );

	if( $script_debug ) {
		wp_register_script( 'hydrogen-plugins', get_template_directory_uri() . "/assets/js/hydrogen.plugins.js", array( 'jquery' ), $theme_version, true );
		wp_register_script( 'hydrogen', get_template_directory_uri() . "/assets/js/hydrogen.setup.js", array( 'bootstrap', 'hydrogen-plugins' ), $theme_version, true );
	} else {
		wp_register_script( 'hydrogen', get_template_directory_uri() . "/assets/js/hydrogen.min.js", array( 'bootstrap' ), $theme_version, true );
	}

	/* Register plugin scripts */
	wp_register_script( 'magnific-popup', get_template_directory_uri() . "/assets/plugins/mfp/jquery.mfp-1.0.0{$suffix}.js", array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'royalslider', get_template_directory_uri() . "/assets/plugins/royalslider/jquery.royalslider.min.js", array( 'jquery' ), '9.5.7', true );
	wp_register_script( 'twitter-text', get_template_directory_uri() . "/assets/js/twitter-text-1.9.1.min.js", array(), '1.9.1', true );

	/* AddThis widget script */
	wp_register_script( 'addthis', 'http://s7.addthis.com/js/300/addthis_widget.js', array(), 300, true );

	/* Pass configuration to frontend */
	wp_localize_script( 'hydrogen', '_hydrogen', apply_filters( 'hydrogen_js_vars', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' )
	)));

	/* Enqueue core scripts */
	wp_enqueue_script( 'hydrogen' );

	/* Enqueue royal slider and magnific popup when displaying blog posts or a single portfolio */
	if( is_singular( array( 'post', 'portfolio' ) ) || is_home() || is_archive() || is_search() ) {

		wp_enqueue_style( 'royalslider' );
		wp_enqueue_script( 'royalslider' );

		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'magnific-popup' );
	}

	/* Additionally enqueue magnific popup when we're on a page with a splash section */
	global $post;
	if( is_a( $post, 'WP_Post' ) && is_page( $post->ID ) ) {

		$splash = wp_parse_args( (array) $post->splash, array( 'enable' => false ) );

		if( $splash['enable'] ) {
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup' );
		}
	}

	/* Load twitter text if the user allows it */
	if( 'on' == ot_get_option( 'include_twttr_text' ) ) {
		wp_enqueue_script( 'twitter-text' );
	}

	/* Enqueue AddThis script on blog pages */
	if( is_singular( 'post' ) && 'on' == ot_get_option( 'blog_show_addthis' ) ) {
		wp_enqueue_script( 'addthis' );
		wp_localize_script( 'addthis', 'addthis_config', array(
			'ui_delay' => 100
		));
	}

	/* Enqueue comment-reply script */
	if( is_a( $post, 'WP_Post' ) && post_type_supports( $post->post_type, 'comments' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'hydrogen_wp_enqueue_script' );
