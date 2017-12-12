<?php
$location = is_single() ? 'post' : 'index';
$classes  = 'sidebar col-md-4';
if( 'left_sidebar' == ot_get_option( "blog_{$location}_layout" ) ) {
	$classes .= ' col-md-pull-8';
}

if( is_active_sidebar( ot_get_option( "blog_{$location}_sidebar" ) ) ) : ?>
<aside id="<?php echo esc_attr( ot_get_option( "blog_{$location}_sidebar" ) ) ?>" class="<?php echo esc_attr( $classes ) ?>">
	<?php dynamic_sidebar( ot_get_option( "blog_{$location}_sidebar" ) ); ?>
</aside>
<?php endif; ?>