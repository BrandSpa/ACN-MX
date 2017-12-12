<form method="get" role="form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<div class="form-group">
		<label class="sr-only" for="search-query"><?php _e( 'Search', 'youxi' )  ?></label>
		<input id="search-query" type="text" class="form-control" placeholder="<?php _e( 'To search type &amp; hit enter', 'youxi' ) ?>" name="s" value="<?php the_search_query() ?>">
	</div>
</form>