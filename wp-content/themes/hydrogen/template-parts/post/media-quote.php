<?php
$meta = hydrogen_extract_post_format_meta();
if( is_array( $meta ) ):
?><div class="post-media">

	<blockquote>

		<?php echo wpautop( $meta['text'] );

		if( '' !== $meta['author'] ): ?>
		
		<small>
			<?php echo esc_html( $meta['author'] ) ?>
			<?php if( '' !== $meta['source'] ): ?>
				<?php if( '' !== $meta['source_url'] ): ?>
				<a href="<?php echo esc_url( $meta['source_url'] ) ?>">
					<?php echo esc_html( $meta['source'] ) ?>
				</a>
				<?php else: ?>
				<?php echo esc_html( $meta['source'] ) ?>
				<?php endif; ?>
			<?php endif; ?>
		</small>

		<?php endif; ?>

	</blockquote>

</div>
<?php endif; ?>