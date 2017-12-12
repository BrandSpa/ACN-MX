<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi Customize Gallery Control
 *
 * This class adds a gallery select control to WordPress customizer
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

class Youxi_Customize_Gallery_Control extends WP_Customize_Control {

	public $type = 'youxi_gallery';

	public function enqueue() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'youxi-gallery-control', 
			get_template_directory_uri() . "/lib/framework/customizer/controls/assets/js/gallery-control{$suffix}.js", 
			array( 'jquery' ), '1.0', true
		);
		wp_enqueue_style( 'youxi-gallery-control', 
			get_template_directory_uri() . '/lib/framework/customizer/controls/assets/css/gallery-control.css', 
			array(), '1.0', 'screen'
		);
	}

	public function render_content() {

		$attachments = (array) $this->value();

		?><label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<select multiple <?php $this->link(); ?> class="youxi-gallery-control-dropdown">
			<?php foreach ( $attachments as $attachment_id ): 
				echo '<option value="' . esc_attr( $attachment_id ) . '" selected>' . $attachment_id . '</option>';
			endforeach; ?>
		</select>
		<div class="youxi-gallery-control-view"><?php
			foreach( $attachments as $attachment_id ):
				echo '<div>' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</div>';
			endforeach;
		?></div>
		<button type="button" class="button youxi-gallery-control-clear"<?php if( empty( $attachments ) ) echo ' style="display: none;"' ?>><?php _e( 'Clear', 'youxi' ) ?></button>
		<?php
	}
}