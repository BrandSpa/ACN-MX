	<footer class="site-footer">

		<?php ob_start(); ?>

		<div class="footer-logo">

			<div class="container">

				<div class="row">

					<div class="col-md-12">
						<?php if( ot_get_option( 'footer_logo' ) ): ?>
						<img src="<?php echo ot_get_option( 'footer_logo' ) ?>" style="width: <?php echo ot_get_option( 'footer_logo_width' ) ?>px" alt="<?php bloginfo( 'name' ); ?>">
						<?php else: ?>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png' ?>" style="width: <?php echo ot_get_option( 'footer_logo_width' ) ?>px" alt="<?php bloginfo( 'name' ); ?>">
						<?php endif; ?>
					</div>

				</div>

			</div>

		</div>
		<?php
			$footer_logo = ob_get_contents();
			ob_clean();
		?>

		<div class="footer-widgets">

			<div class="container">

				<div class="row">

					<?php for( $i = 1, $j = ot_get_option( 'footer_widgets_cols' ); $i <= $j; $i++ ): ?>

						<?php if( is_active_sidebar( "footer_widget_area_{$i}" ) ): ?>
							<?php dynamic_sidebar( "footer_widget_area_{$i}" ) ?>
						<?php endif; ?>

					<?php endfor; ?>

				</div>

			</div>

		</div>

		<?php
			$footer_widgets = ob_get_clean();

			foreach( explode( '_', ot_get_option( 'footer_layout' ) ) as $layout ):
				if( isset( ${"footer_{$layout}"} ) ): 
					echo ${"footer_{$layout}"};
				endif;
			endforeach;
		?>

		<div class="footer-bottom">

			<div class="container">

				<div class="row">

					<div class="col-md-12">

						<div class="footer-text"><?php echo ot_get_option( 'footer_text' ) ?></div>

						<?php if( $footer_social_icons = ot_get_option( 'footer_social_icons' ) ):
						?><div class="social-list">
							<ul>
								<?php foreach( $footer_social_icons as $footer_social_icon ):
									$footer_social_icon = wp_parse_args( $footer_social_icon, array(
										'url' => '#', 
										'title' => '', 
										'icon' => ''
									)); ?>
								<li>
									<a href="<?php echo esc_url( $footer_social_icon['url'] ) ?>" title="<?php echo $footer_social_icon['title'] ?>">
										<i class="<?php echo $footer_social_icon['icon'] ?>"></i>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>

					</div>

				</div>

			</div>

		</div>

	</footer>

</div>

<?php wp_footer() ?>
</html>
