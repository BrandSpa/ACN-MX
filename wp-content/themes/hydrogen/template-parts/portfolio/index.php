<?php
$attributes = array(
	'show_title' => $show_title, 
	'ajax_loading' => $ajax_loading, 
	'posts_per_page' => $posts_per_page, 
	'orderby' => $orderby, 
	'view_method' => $view_method, 
	'thumbnail_link' => $thumbnail_link, 
	'thumbnail_size' => $thumbnail_size, 
	'exclude' => $exclude
);

$project_classes = array( 'projects' );

$column_classes = array(
	3 => 'three-columns', 
	5 => 'five-columns'
);
$columns = intval( $columns );
if( isset( $column_classes[ $columns ] ) ) {
	$project_classes[] = $column_classes[ $columns ];
}

?><div class="<?php echo esc_attr( implode( ' ', $project_classes ) ) ?>" data-portfolio-atts="<?php echo esc_attr( json_encode( $attributes ) ) ?>">

	<?php
	// Backup current post
	global $post;
	$tmp_post = $post;

	// Make sure the excluded categories is an array
	if( is_string( $exclude ) ) {
		$exclude = explode( ',', $exclude );
	}
	if( ! is_array( $exclude ) ) {
		$exclude = array();
	}

	/* Get portfolio taxonomy terms */
	$terms = get_terms( youxi_portfolio_tax_name(), compact( 'exclude' ) );

	/* Output portfolio filters */
	if( ( ! isset( $show_filter ) || $show_filter ) && $terms ): ?>
	<div class="filter">
		<span class="active-label visible-xs" data-toggle="dropdown"><?php esc_html_e( 'All', 'youxi' ) ?></span>
		<ul>
			<li class="active">
				<a href="<?php echo get_post_type_archive_link( youxi_portfolio_cpt_name() ) ?>" data-filter="*">
					<?php esc_html_e( 'All', 'youxi' ) ?>
				</a>
			</li>
			<?php foreach( $terms as $term ):
				if( empty( $term->slug ) ) {
					continue;
				}

				$term_link = get_term_link( $term );
				$term_link = is_wp_error( $term_link ) ? '#' : $term_link;
			?>
			<li>
				<a href="<?php echo $term_link ?>" data-filter=".<?php echo esc_attr( $term->slug ) ?>">
					<?php echo esc_html( $term->name ) ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
	endif;

	/* Determine WP_Query arguments */
	$wp_query = array(
		'post_type' => youxi_portfolio_cpt_name(), 
		'posts_per_page' => $ajax_loading ? $posts_per_page : -1, 
		'offset' => $offset, 
		'orderby' => $orderby, 
		'order' => ( 'post_date' == $orderby ? 'DESC' : 'ASC' ), 
		'no_found_rows' => true, 
		'suppress_filters' => false
	);

	/* Make sure not to query empty taxonomies */
	$exclude = array_filter( $exclude );
	if( $exclude ) {
		$wp_query['tax_query'] = array(
			array(
				'taxonomy' => youxi_portfolio_tax_name(), 
				'field' => 'id', 
				'terms' => $exclude, 
				'operator' => 'NOT IN'
			)
		);
	}

	/* Run the query */
	$wp_query = new WP_Query( $wp_query );

	/* If projects found */
	if( $wp_query->have_posts() ): ?>

	<div class="items">

		<div class="grid-sizer"></div>
		<div class="gutter-sizer"></div>

		<?php

		/* Get attachment ids */
		$attachments = array();
		while( $wp_query->have_posts() ): $wp_query->the_post();
			if( has_post_thumbnail() ) {
				$attachments[] = get_post_thumbnail_id();
			}
		endwhile;

		/* Trigger attachments caching to reduce database queries */
		hydrogen_trigger_attachments_caching( $attachments );		

		/* Render project items */
		while( $wp_query->have_posts() ): $wp_query->the_post();

			$post_terms = wp_get_post_terms( get_the_ID(), get_object_taxonomies( get_post_type() ) );
			$post_class = array_merge( array( 'project' ), wp_list_pluck( $post_terms, 'slug' ) );

			$post_url = apply_filters( 'the_permalink', get_permalink() );
			$post_url_is_ajax = ( 'ajax' == $view_method );

			if( 'url' == $view_method ) {
				$general = wp_parse_args( (array) $post->general, array( 'url' => '' ) );
				if( filter_var( $general['url'], FILTER_VALIDATE_URL ) ) {
					$post_url = $general['url'];
				}
			}
		?>

		<div <?php post_class( $post_class ); echo hydrogen_arr_get( $animate, 'items' ); ?>>
			<?php if( has_post_thumbnail() ): ?>
			<div class="project-image">
				<?php
					$thumbnail = get_the_post_thumbnail( null, $thumbnail_size );
					switch( $thumbnail_link ):
						case 'none':
							echo $thumbnail;
							break;
						case 'direct':
							echo '<a href="' . esc_url( $post_url ) . '"' . ( $post_url_is_ajax ? ' class="is-ajax"' : '' ) . '>' . $thumbnail . '</a>';
							break;
						case 'buttons':
						default:
							echo $thumbnail;
				?><div class="overlay">
					<ul class="actions">
						<?php if( $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ): ?>
						<li class="mfp-zoom">
							<a href="<?php echo esc_url( $image[0] ) ?>">
								<i class="gi gi-resize-full"></i>
							</a>
						</li>
						<?php endif; ?>
						<li class="mfp-details<?php echo esc_attr( $post_url_is_ajax ? ' is-ajax' : '' ) ?>">
							<a href="<?php echo esc_url( $post_url ) ?>">
								<i class="gi gi-search"></i>
							</a>
						</li>
					</ul>
				</div>
				<?php break; endswitch; ?>
			</div>
			<?php endif; ?>
			<?php if( $show_title || ! has_post_thumbnail() ): ?>
			<div class="project-info">
				<h4 class="project-name">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</h4>
				<div class="project-categories">
					<?php echo implode( ', ', wp_list_pluck( $post_terms, 'name' ) ) ?>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<?php endwhile; ?>

	</div>
	<?php
	endif;

	// Restore the previous post
	$post = $tmp_post;
	if( is_a( $post, 'WP_Post' ) ) {
		setup_postdata( $post );
	}

	if( $ajax_loading && hydrogen_portfolio_count( $exclude ) > $posts_per_page ): ?>
	<div class="project-load-more">
		<a href="#"><i class="gi gi-plus"></i></a>
	</div>
	<?php endif; ?>

</div>