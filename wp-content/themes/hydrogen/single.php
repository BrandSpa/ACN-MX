<?php get_header() ?>

<div class="site-wrapper">
	
	<div class="site-body">

		<?php if( have_posts() ): the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endif; ?>

	</div>

<?php get_footer() ?>