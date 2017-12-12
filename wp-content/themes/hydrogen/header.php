<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>

<?php
do_action( 'hydrogen_before_header' );

$header_style = '';
if( ot_get_option( 'header_style' ) ) {
	$header_style .= ' style-' . ot_get_option( 'header_style' );
}
?><header class="site-header<?php echo $header_style ?>">

	<div class="header-inner">

		<div class="container">

			<div class="row">

				<div class="header-table col-md-12">

					<?php do_action( 'hydrogen_header_content' ); ?>

				</div>

			</div>

		</div>

	</div>

</header>

<?php do_action( 'hydrogen_after_header' ) ?>
