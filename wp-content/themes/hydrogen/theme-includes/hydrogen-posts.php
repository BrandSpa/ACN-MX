<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Before Posts Callback
 */
if( ! function_exists( 'hydrogen_blog_posts_before_callback' ) ):

function hydrogen_blog_posts_before_callback() {

	$location = is_single() ? 'post' : 'index';
	$container_class = 'col-md-12';

	if( is_active_sidebar( ot_get_option( "blog_{$location}_sidebar" ) ) ) {

		switch( ot_get_option( "blog_{$location}_layout" ) ) {
			case 'left_sidebar':
				$container_class = 'col-md-8 col-md-push-4';
				break;
			case 'right_sidebar':
				$container_class = 'col-md-8';
				break;
		}

	}

	echo '<div class="' . esc_attr( $container_class ) . '">';

}
endif;
add_action( 'hydrogen_blog_posts_before', 'hydrogen_blog_posts_before_callback' );

/**
 * After Posts Callback
 */
if( ! function_exists( 'hydrogen_blog_posts_after_callback' ) ):

function hydrogen_blog_posts_after_callback() {

	if( ! is_single() ) {
		hydrogen_posts_pagination();
	}

	echo '</div>';

	$location = is_single() ? 'post' : 'index';
	$layout   = ot_get_option( "blog_{$location}_layout" );
	if( preg_match( '/^(lef|righ)t_sidebar$/', $layout ) ) {
		get_sidebar();
	}
}
endif;
add_action( 'hydrogen_blog_posts_after', 'hydrogen_blog_posts_after_callback' );

/**
 * Posts Pagination
 */
if( ! function_exists( 'hydrogen_posts_pagination' ) ):

function hydrogen_posts_pagination() {
	// Don't print empty markup if there's only one page.
	if( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	if( 'numbered' == ot_get_option( get_post_type() . '_pagination' ) ):

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link, 
			'format'   => $format, 
			'total'    => $GLOBALS['wp_query']->max_num_pages, 
			'current'  => $paged, 
			'mid_size' => 1, 
			'type'     => 'array', 
			'add_args' => array_map( 'urlencode', $query_args ), 
			'prev_text' => __( '&larr; Previous', 'youxi' ), 
			'next_text' => __( 'Next &rarr;', 'youxi' )
		));

		if( $links ): ?>
		<nav class="posts-pagination">
			<ul class="pagination pagination-sm">
				<?php printf( '<li>%s</li>', join( '</li><li>', $links ) ); ?>
			</ul>
		</nav>
		<?php endif;
	else: ?>
		<ul class="pager">
			<li class="previous">
				<?php previous_posts_link( __( '&larr; Previous', 'youxi' ) ); ?>
			</li>
			<li class="next">
				<?php next_posts_link( __( 'Next &rarr;', 'youxi' ) ); ?>
			</li>
		</ul>
	<?php endif;
}
endif;

/**
 * Get Related Posts
 */

if( ! function_exists( 'hydrogen_related_posts' ) ):

function hydrogen_related_posts( $limit = 4, $post_id = null ) {
	$post = get_post( $post_id );
	$posts = array();

	if( is_a( $post, 'WP_Post' ) ) {

		$tax_query = array(
			'relation' => 'OR'
		);

		foreach( get_object_taxonomies( $post->post_type ) as $taxonomy ) {
			if( $terms = get_the_terms( $post->ID, $taxonomy ) ) {
				$tax_query[] = array(
					'taxonomy' => $taxonomy, 
					'field' => 'id', 
					'terms' => wp_list_pluck( $terms, 'term_id' )
				);
			}
		}

		$posts = get_posts(array(
			'post_type' => $post->post_type, 
			'tax_query' => $tax_query, 
			'posts_per_page' => $limit, 
			'post__not_in' => array( $post->ID ), 
			'orderby' => 'RAND'
		));
	}

	return $posts;
}
endif;

/**
 * Post Meta Formatter
 */
if( ! function_exists( 'hydrogen_post_meta' ) ):

function hydrogen_post_meta() {

	ob_start();

	comments_popup_link( __( 'no comments', 'youxi' ), __( '1 comment', 'youxi' ), __( '% comments', 'youxi' ) );
	$comments = ob_get_contents();
	ob_clean();

	the_author_posts_link();
	$author = ob_get_clean();

	return strtr( ot_get_option( is_single() ? 'blog_post_meta_format' : 'blog_index_meta_format' ), array(
		'{author}'     => $author, 
		'{datetime}'   => get_the_time( ot_get_option( 'blog_time_format' ) ), 
		'{comments}'   => $comments, 
		'{categories}' => get_the_category_list( __( ', ', 'youxi' ) ), 
		'{tags}'       => get_the_tag_list( '', __( ', ', 'youxi' ) ), 
		'{dot}'        => '<span class="dot"></span>'
	));
}
endif;

/**
 * Limit searching to posts only
 */
if( ! function_exists( 'hydrogen_pre_get_posts' ) ):

function hydrogen_pre_get_posts( $query ) {
	if( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}
endif;
add_filter( 'pre_get_posts', 'hydrogen_pre_get_posts' );

/**
 * wp_list_comments Callback
 */
if( ! function_exists( 'hydrogen_comment' ) ):

function hydrogen_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?><li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'hydrogen' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'youxi' ), '<div class="comment-edit-link">', '</div>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
	?><li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="comment-entry clearfix">
			<figure class="comment-avatar">
				<?php if( get_the_author_meta( 'url' ) ):
					echo '<a href="' . esc_url( get_the_author_meta( 'url' ) ) . '" rel="author external">' . get_avatar( $comment, 120 ) . '</a>';
				else:
					echo get_avatar( $comment, 120 );
				endif; ?>
			</figure>
			<div class="comment-text">
				<header class="comment-head clearfix">
					<span class="name"><?php comment_author_link() ?></span>
					<span class="meta">
						<span class="time"><?php printf( __( '%1$s at %2$s', 'youxi' ), get_comment_date(), get_comment_time() ) ?></span>
						<?php comment_reply_link( array_merge( $args, array( 'before' => ' / ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				</header>
				<section class="comment-content">
					<?php comment_text(); ?>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="text-warning text-italic"><?php _e( 'Your comment is awaiting moderation.', 'youxi' ); ?></p>
					<?php endif; ?>
					<?php edit_comment_link( __( 'Edit', 'youxi' ), '<div class="comment-edit-link">', '</div>' ); ?>
				</section>
			</div>
		</article>
	<?php
		break;
	endswitch;
}
endif;

/**
 * Comment Form Defaults
 */
if( ! function_exists( 'hydrogen_comment_form_defaults' ) ):

function hydrogen_comment_form_defaults( $defaults ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	
	$defaults['fields'] = array(
		'author' => 
			'<div class="form-group comment-form-author">' . 
				'<label class="sr-only" for="author">' . _x( 'Name', 'noun', 'youxi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .  '" class="form-control" placeholder="' . _x( 'Name', 'noun', 'youxi' ) . ( $req ? ' *' : '' )  .  '" >' . 
				'</div>' . 
			'</div>', 
		'email' => 
			'<div class="form-group comment-form-email">' . 
				'<label class="sr-only" for="email">' . _x( 'Email', 'noun', 'youxi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .  '" class="form-control" placeholder="' . _x( 'Email', 'noun', 'youxi' ) . ( $req ? ' *' : '' )  .  '" >' . 
				'</div>' . 
			'</div>', 
		'url' => 
			'<div class="form-group comment-form-url">' . 
				'<label class="sr-only" for="url">' . _x( 'URL', 'noun', 'youxi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .  '" class="form-control" placeholder="' . _x( 'URL', 'noun', 'youxi' ) . '" >' . 
				'</div>' . 
			'</div>'
	);

	$defaults['comment_field'] =  
		'<div class="form-group comment-form-comment">' . 
			'<label class="sr-only" for="comment">' . _x( 'Comment', 'noun', 'youxi' ) . '</label>' . 
			'<div class="col-md-12">' . 
				'<textarea id="comment" name="comment" rows="7" class="form-control" placeholder="' . _x( 'Comment', 'noun', 'youxi' ) . '"></textarea>' . 
			'</div>' . 
		'</div>';

	return $defaults;
}
endif;
add_filter( 'comment_form_defaults', 'hydrogen_comment_form_defaults' );

/**
 * Comment Form Top
 */
if( ! function_exists( 'hydrogen_comment_form_top' ) ):

function hydrogen_comment_form_top() {
	echo '<div class="form-horizontal">';
}
endif;
add_action( 'comment_form_top', 'hydrogen_comment_form_top' );

/**
 * Comment Form
 */
if( ! function_exists( 'hydrogen_comment_form' ) ):

function hydrogen_comment_form() {
	echo '</div>';
}
endif;
add_action( 'comment_form', 'hydrogen_comment_form' );

/**
 * Retrieve validated post format metadata from a post object
 */
if( ! function_exists( 'hydrogen_extract_post_format_meta' ) ):

function hydrogen_extract_post_format_meta( $post = null ) {

	$post = get_post( $post );
	if( is_a( $post, 'WP_Post' ) && function_exists( 'youxi_post_format_id' ) ) {

		$post_format = get_post_format( $post->ID );
		$meta_key    = youxi_post_format_id( $post_format );
		$post_meta   = (array) $post->$meta_key;

		switch( $post_format ) {
			case 'video':
				$post_meta = wp_parse_args( $post_meta, array(
					'type' => '', 
					'embed' => '', 
					'src' => '', 
					'poster' => ''
				));
				if( ( 'embed' == $post_meta['type'] && '' !== $post_meta['embed'] ) || 
					( 'hosted' == $post_meta['type'] && '' !== $post_meta['src'] ) ) {
					return $post_meta;
				}
				break;
			case 'audio':
				$post_meta = wp_parse_args( $post_meta, array(
					'type' => '', 
					'embed' => '', 
					'src' => ''
				));
				if( ( 'embed' == $post_meta['type'] && '' !== $post_meta['embed'] ) || 
					( 'hosted' == $post_meta['type'] && '' !== $post_meta['src'] ) ) {
					return $post_meta;
				}
				break;
			case 'gallery':
				$post_meta = wp_parse_args( $post_meta, array( 'images' => array() ) );
				if( ! empty( $post_meta['images'] ) && is_array( $post_meta['images'] ) ) {
					return $post_meta;
				}
				break;
			case 'quote':
				$post_meta = wp_parse_args( $post_meta, array(
					'text' => '', 
					'author' => '', 
					'source' => '', 
					'source_url' => ''
				));
				if( '' !== $post_meta['text'] ) {
					return $post_meta;
				}
				break;
			case 'link':
				return wp_parse_args( $post_meta, array( 'link_url' => '' ) );
			case 'image':
			case 'aside':
			default:
				break;
		}

	}
}
endif;