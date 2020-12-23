<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.06
 */

$hoverex_header_css = '';
$hoverex_header_image = get_header_image();
$hoverex_header_video = hoverex_get_header_video();
if (!empty($hoverex_header_image) && hoverex_trx_addons_featured_image_override(is_singular() || hoverex_storage_isset('blog_archive') || is_category())) {
	$hoverex_header_image = hoverex_get_current_mode_image($hoverex_header_image);
}

$hoverex_header_id = str_replace('header-custom-', '', hoverex_get_theme_option("header_style"));
if ((int) $hoverex_header_id == 0) {
	$hoverex_header_id = hoverex_get_post_id(array(
												'name' => $hoverex_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$hoverex_header_id = apply_filters('hoverex_filter_get_translated_layout', $hoverex_header_id);
}
$hoverex_header_meta = get_post_meta($hoverex_header_id, 'trx_addons_options', true);
if (!empty($hoverex_header_meta['margin']) != '') 
	hoverex_add_inline_css(sprintf('.page_content_wrap{padding-top:%s}', esc_attr(hoverex_prepare_css_value($hoverex_header_meta['margin']))));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($hoverex_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($hoverex_header_id)));
				echo !empty($hoverex_header_image) || !empty($hoverex_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($hoverex_header_video!='') 
					echo ' with_bg_video';
				if ($hoverex_header_image!='') 
					echo ' '.esc_attr(hoverex_add_inline_css_class('background-image: url('.esc_url($hoverex_header_image).');'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (hoverex_is_on(hoverex_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight hoverex-full-height';
				if (!hoverex_is_inherit(hoverex_get_theme_option('header_scheme')))
					echo ' scheme_' . esc_attr(hoverex_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($hoverex_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('hoverex_action_show_layout', $hoverex_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>