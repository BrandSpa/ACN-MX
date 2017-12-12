<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Before Header Callback
 */
if( ! function_exists( 'hydrogen_before_header_callback' ) ):

function hydrogen_before_header_callback() {

	if( 'on' == ot_get_option( 'enable_preloader' ) ):
		$preloader_style = '';
		if( ot_get_option( 'preloader_style' ) ) {
			$preloader_style .= ' style-' . ot_get_option( 'preloader_style' );
		}
	?>
	<div class="site-loader<?php echo $preloader_style ?>"></div>
	<?php endif;

	global $post;
	if( is_a( $post, 'WP_Post' ) && is_page( $post->ID ) ) {

		$splash = wp_parse_args( (array) $post->splash, array(
			'type' => 'slider', 
			'height' => 0, 
			'slider_content' => array(), 
			'slider_duration' => 4000, 
			'slider_bg' => 0, 
			'slider_bg_img' => '', 
			'slider_bg_img_mode' => 'none', 
			'slider_bg_img_parallax_speed' => 0.3, 
			'slider_bg_video_src' => '', 
			'slider_bg_video_poster' => '', 
			'ls_slider_id' => '', 
			'feedback_text' => ''
		));

		if( $splash['type'] ) {
		
			$template = locate_template( 'template-parts/splash.php' );

			if( '' !== $template ) {

				extract( $splash, EXTR_SKIP );
				require( $template );
			}
		}

	}

}
endif;
add_action( 'hydrogen_before_header', 'hydrogen_before_header_callback' );

/**
 * Outputs the site logo in header
 */
if( ! function_exists( 'hydrogen_header_brand' ) ):

function hydrogen_header_brand() {
	?>
	<div class="header-col brand">
		<a href="<?php echo is_front_page() ? '#' : home_url() ?>">
			<?php if( ot_get_option( 'main_logo' ) ): ?>
			<img src="<?php echo ot_get_option( 'main_logo' ) ?>" alt="<?php bloginfo( 'name' ); ?>">
			<?php else: ?>
			<img src="<?php echo get_template_directory_uri() . '/assets/img/logo-wide.png' ?>" alt="<?php bloginfo( 'name' ); ?>">
			<?php endif; ?>
		</a>
	</div>
	<?php
}
endif;
add_action( 'hydrogen_header_content', 'hydrogen_header_brand', 10 );

/**
 * Outputs the navigation in header
 */
if( ! function_exists( 'hydrogen_header_nav' ) ):

function hydrogen_header_nav() {
	?>
	<nav class="header-col main-nav">
		<a href="#" class="nav-toggle"></a>
		<?php wp_nav_menu(array(
			'theme_location' => 'main-menu', 
			'container' => false, 
			'menu_class' => 'nav', 
			'fallback_cb' => 'hydrogen_fallback_nav_menu', 
			'walker' => new Hydrogen_Walker_Nav_Menu()
		)) ?>
	</nav>
	<?php
}
endif;
add_action( 'hydrogen_header_content', 'hydrogen_header_nav', 11 );

/**
 * Main Menu fallback
 */
if( ! function_exists( 'hydrogen_fallback_nav_menu' ) ) {

	function hydrogen_fallback_nav_menu() {
		?><ul class="menu">
			<?php /* add home button */ ?>
			<li class="<?php if( is_home() || is_front_page() ) echo esc_attr( 'current-menu-item' ); ?>">
				<a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'youxi' ) ?></a>
			</li>
			<?php
			/**
			 * Show the pages we want
			 * We shall be using wp_list_pages
			 * For a list of arguments
			 * @see http://codex.wordpress.org/Function_Reference/wp_list_pages
			 */
			$exclude = get_option( 'page_on_front' );
			wp_list_pages( 'title_li=&sort_column=menu_order' . ( $exclude ? '&exclude=' . $exclude : '' ) );
			?>
		</ul><?php
	}
}

/**
 * Outputs a single WPML language element
 */
if( ! function_exists( 'hydrogen_language_selector' ) ):

function hydrogen_language_selector( $lang, $before = '', $after = '' ) {

	$lang = wp_parse_args( (array) $lang, array(
		'id' => '', 
		'active' => false, 
		'native_name' => '', 
		'missing' => false, 
		'translated_name' => '', 
		'language_code' => '', 
		'country_flag_url' => '', 
		'url' => ''
	));

	echo $before;

	if( ! $lang['active'] ):
		echo '<a href="' . esc_url( $lang['url'] ) . '" class="lang-element">';
	else:
		echo '<span class="lang-element">';
	endif;

	if( $lang['country_flag_url'] ):
		echo '<img src="' . esc_url( $lang['country_flag_url'] ) . '" alt="' . esc_attr( $lang['language_code'] ) . '">';
	endif;

	echo esc_html( $lang['translated_name'] );

	if( ! $lang['active'] ):
		echo '</a>';
	else:
		echo '</span>';
	endif;

	echo $after;
}
endif;

/**
 * Outputs WPML language switcher in header
 */
if( ! function_exists( 'hydrogen_header_wpml' ) ):

function hydrogen_header_wpml() {

	if( function_exists( 'icl_get_languages' ) ):

		$languages = icl_get_languages( 'skip_missing=1' );

		if( ! empty( $languages ) ): ?>
		<div class="header-col language-switcher">
			<ul>
				<?php
					$active   = wp_list_filter( $languages, array( 'active' => true ) );
					$inactive = wp_list_filter( $languages, array( 'active' => false ) );

					if( is_array( $active ) && ! empty( $active ) ):
						echo hydrogen_language_selector( current( $active ), '<li class="active-lang">' );
					endif; ?>

					<?php if( is_array( $inactive ) && ! empty( $inactive ) ): ?>
					<ul>
						<?php foreach( $inactive as $id => $lang ):
							hydrogen_language_selector( $lang, '<li>', '</li>' );
						endforeach; ?>
					</ul>
				<?php endif; ?>
				</li>
			</ul>
		</div>
		<?php endif;
	endif;
}
endif;
//add_action( 'hydrogen_header_content', 'hydrogen_header_wpml', 12 );

/**
 * Container shortcode content filter, used on the first container in a page block.
 */
if( ! function_exists( 'hydrogen_container_shortcode_content_callback' ) ):

function hydrogen_container_shortcode_content_callback( $content ) {

	if( hydrogen_is_page_block_first_access() ) {

		global $post;
		if( is_a( $post, 'WP_Post' ) && Youxi_One_Pager::post_type_name() == $post->post_type ) {

			/* Only continue if the post uses page builder to compose the content */
			if( $post->layout && isset( $post->layout['use_builder'] ) && ! $post->layout['use_builder'] ) {
				return $content;
			}

			$title_meta = wp_parse_args( (array) $post->title, array(
				'visible' => true, 
				'element' => 'h1', 
				'subtitle' => '', 
				'highlight_subtitle' => false, 
				'layout' => 'fullwidth', 
				'alignment' => 'left', 
				'show_counter' => true, 
				'col_type' => 'lg', 
				'title_size' => 3, 
				'content_size' => 9, 
				'gap_size' => 0
			));

			extract( $title_meta );

			if( $visible ) {

				if( ! preg_match( '/^align_(lef|righ)t$/', $layout ) ) {
					$title_size = 12;
				}

				$title_size = min( max( 1, $title_size ), 12 );
				$content_size = min( max( 1, $content_size ), 12 );

				/* Determine wrapper classes */
				$twrap_class = 'col-' . $col_type . '-' . $title_size;
				$cwrap_class = 'col-' . $col_type . '-' . $content_size;

				switch( $layout ) {
					case 'align_left':
						if( $gap_size ) {
							$cwrap_class .= ' col-' . $col_type . '-push-' . $gap_size;
						}
						break;
					case 'align_right':
						$twrap_class .= ' col-' . $col_type . '-push-' . ( $content_size + $gap_size );
						$cwrap_class .= ' col-' . $col_type . '-pull-' . $title_size;
						break;
				}

				/* Title HTML markup */
				$title_html = '<div class="' . esc_attr( $twrap_class ) . '">';

					/* Prepare title classes */
					$title_class = '';

					if( 'subtitle' == $layout ) {
						$title_class .= 'section-subtitle';
					} else {
						$title_class .= 'section-title';
						if( $show_counter ) {
							$title_class .= ' show-counter';
						}
					}

					if( in_array( $alignment, array( 'center', 'right' ) ) ) {
						$title_class .= ' text-' . $alignment;
					}

					/* Construct title */
					$title_html .= '<' . $element . ' class="' . esc_attr( $title_class ) . '">';

						$title_html .= get_the_title();

						if( $subtitle ) {

							$title_html .= '<small>';

							if( $highlight_subtitle ) {
								$title_html .= '<span class="highlight">' . $subtitle . '</span>';
							} else {
								$title_html .= $subtitle;
							}

							$title_html .= '</small>';

						}

					$title_html .= '</' . $element . '>';

				$title_html .= '</div>';

				switch( $layout ) {
					case 'align_left':
					case 'align_right':
						$result = '<div class="row">';
							$result .= $title_html;
							$result .= '<div class="' . esc_attr( $cwrap_class ) . '">';
								$result .= $content;
							$result .= '</div>';
						$result .= '</div>';
						break;
					case 'fullwidth':
					default:
						$result = '<div class="row">' . $title_html . '</div>' . $content;
						break;
				}

				$content = $result;
			}
		}
	}

	return $content;
}
endif;
add_filter( 'hydrogen_container_shortcode_content', 'hydrogen_container_shortcode_content_callback' );

/**
 * Filter post classes to add custom styles
 */
if( ! function_exists( 'hydrogen_post_class' ) ):

function hydrogen_post_class( $classes, $class, $post_id ) {

	$post = get_post( $post_id );
	if( is_a( $post, 'WP_Post' ) ) {

		$style_map = array(
			'post' => 'blog_style', 
			'page' => 'page_style', 
			'portfolio' => 'portfolio_style'
		);

		/* Construct post style based on single post / general setting */		
		if( is_string( $post->style ) && ! empty( $post->style ) ) {
			$classes[] = 'style-' . $post->style;
		} elseif( array_key_exists( $post->post_type, $style_map ) ) {
			$post_style = ot_get_option( $style_map[ $post->post_type ] );
			if( ! empty( $post_style ) ) {
				$classes[] = 'style-' . $post_style;
			}
		}
	}

	return $classes;
}
endif;
add_filter( 'post_class', 'hydrogen_post_class', 10, 3 );
