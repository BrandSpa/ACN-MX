<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

<h4><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'youxi' ), admin_url( 'post-new.php' ) ); ?></h4>

<?php elseif ( is_search() ) : ?>

<h4><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'youxi' ); ?></h4>
<?php get_search_form(); ?>

<?php else : ?>

<h4><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'youxi' ); ?></h4>
<?php get_search_form(); ?>

<?php endif; ?>
