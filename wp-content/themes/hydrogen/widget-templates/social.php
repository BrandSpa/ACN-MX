<?php if( ! empty( $items ) ): ?>
<div class="social-list">
	<ul>
		<?php foreach( $items as $item ):
			$item = wp_parse_args( $item, array(
				'url'   => '', 
				'title' => '', 
				'icon'  => ''
			));
		?><li>
			<a href="<?php echo $item['url'] ?>" <?php echo ! empty( $item['title'] ) ? 'title="' . $item['title'] . '"' : '' ?>>
				<i class="ics ics-<?php echo $item['icon'] ?>"></i>
			</a>
		</li><?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>
