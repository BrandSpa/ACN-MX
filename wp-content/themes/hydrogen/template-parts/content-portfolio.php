<?php
/* Parse general attributes */
$general = wp_parse_args( (array) $post->general, array(
	'subtitle' => '', 
	'url' => '', 
	'client' => '', 
	'client_url' => ''
));

/* Parse layout attributes */
$layout = wp_parse_args( (array) $post->layout, array(
	'type' => 'fullwidth', 
	'sidebar' => 'attributes', 
	'sidebar_id' => '', 
	'details' => array()
));

/* Parse media attributes */
$media = wp_parse_args( (array) $post->media, array( 'type' => 0 ) );

?><section id="<?php echo esc_attr( $post->post_name ) ?>" <?php post_class( 'section project-details' ) ?>>
	<div class="section-row-container">
		<div class="section-row project-title three-quarters-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php
							$subtitle = $general['subtitle'] ? '<small>' . $general['subtitle'] . '</small>' : '';
							the_title( '<h1 class="page-title text-center">', $subtitle . '</h1>' );
						?>
					</div>
				</div>
			</div>
		</div>
		<?php if( $media['type'] ): ?>
		<div class="section-row<?php echo hydrogen_portfolio_classes( 'media', $media['type'] ) ?>">
			<div class="media-container">
				<?php get_template_part( 'template-parts/' . get_post_type() . '/media', $media['type'] ) ?>
			</div>
		</div>
		<?php endif;
		if( 'builder' == $layout['type'] ):
			the_content();
		else: ?>
		<div class="section-row<?php echo hydrogen_portfolio_classes( 'description', $media['type'] ) ?>">
			<div class="container">
				<div class="row">
				<?php if( 'fullwidth' == $layout['type'] ): ?>
					<div class="col-md-12">
						<?php the_content() ?>
					</div>
				<?php else: ?>
					<div class="col-md-8<?php if( 'left_sidebar' == $layout['type'] ) echo ' col-md-push-4'; ?>">
						<?php the_content() ?>
					</div>
					<aside class="sidebar col-md-4<?php if( 'left_sidebar' == $layout['type'] ) echo ' col-md-pull-8'; ?>">
					<?php switch( $layout['sidebar'] ):
						case 'widget_area':
							if( is_active_sidebar( $layout['sidebar_id'] ) ):
								dynamic_sidebar( $layout['sidebar_id'] );
							endif;
							break;
						case 'details':
							foreach( (array) $layout['details'] as $detail ):
								$detail = wp_parse_args( (array) $detail, array(
									'type' => 'custom', 
									'label' => '', 
									'custom_value' => ''
								));
							?><div class="sidebar-block">
								<?php if( '' != $detail['label'] ):
								?><h4 class="sidebar-title"><?php echo esc_html( $detail['label'] ) ?></h4>
								<?php endif;
								switch( $detail['type'] ):
									case 'categories':
										echo get_the_term_list( $post->ID, youxi_portfolio_tax_name(), '', ', ' );
										break;
									case 'url':
										echo '<a rel="nofollow" href="' . esc_html( $general['url'] ) . '">' . esc_html( $general['url'] ) . '</a>';
										break;
									case 'client':
										if( '' != $general['client_url'] ):
											echo '<a rel="nofollow" href="' . esc_html( $general['client_url'] ) . '">' . esc_html( $general['client'] ) . '</a>';
										else:
											echo esc_html( $general['client'] );
										endif;
										break;
									case 'custom':
									default:
										echo wpautop( $detail['custom_value'] );
								endswitch;
							?></div>
							<?php endforeach;
						default:
							break;
					endswitch;
					?></aside>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
