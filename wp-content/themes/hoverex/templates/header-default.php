<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_header_css = '';
$hoverex_header_image = get_header_image();
$hoverex_header_video = hoverex_get_header_video();
if (!empty($hoverex_header_image) && hoverex_trx_addons_featured_image_override(is_singular() || hoverex_storage_isset('blog_archive') || is_category())) {
	$hoverex_header_image = hoverex_get_current_mode_image($hoverex_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($hoverex_header_image) || !empty($hoverex_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($hoverex_header_video!='') echo ' with_bg_video';
					if ($hoverex_header_image!='') echo ' '.esc_attr(hoverex_add_inline_css_class('background-image: url('.esc_url($hoverex_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (hoverex_is_on(hoverex_get_theme_option('header_fullheight'))) echo ' header_fullheight hoverex-full-height';
					if (!hoverex_is_inherit(hoverex_get_theme_option('header_scheme')))
						echo ' scheme_' . esc_attr(hoverex_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($hoverex_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (hoverex_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Mobile header
	if (hoverex_is_on(hoverex_get_theme_option("header_mobile_enabled"))) {
		get_template_part( 'templates/header-mobile' );
	}
	
	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content


?></header>