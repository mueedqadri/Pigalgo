<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(hoverex_get_theme_option('color_scheme'));
										 ?>">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-97713631-3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-97713631-3');
	</script>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'hoverex_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php
			
			// Desktop header
			$hoverex_header_type = hoverex_get_theme_option("header_type");
			if ($hoverex_header_type == 'custom' && !hoverex_is_layouts_available())
				$hoverex_header_type = 'default';
			get_template_part( "templates/header-{$hoverex_header_type}");

			// Side menu
			if (in_array(hoverex_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}
			
			// Mobile menu
			get_template_part( 'templates/header-navi-mobile');
			?>

			<div class="page_content_wrap">

				<?php if (hoverex_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					hoverex_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						hoverex_create_widgets_area('widgets_above_content');
						?>				
