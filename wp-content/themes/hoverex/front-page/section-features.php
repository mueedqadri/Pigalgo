<div class="front_page_section front_page_section_features<?php
			$hoverex_scheme = hoverex_get_theme_option('front_page_features_scheme');
			if (!hoverex_is_inherit($hoverex_scheme)) echo ' scheme_'.esc_attr($hoverex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(hoverex_get_theme_option('front_page_features_paddings'));
		?>"<?php
		$hoverex_css = '';
		$hoverex_bg_image = hoverex_get_theme_option('front_page_features_bg_image');
		if (!empty($hoverex_bg_image)) 
			$hoverex_css .= 'background-image: url('.esc_url(hoverex_get_attachment_url($hoverex_bg_image)).');';
		if (!empty($hoverex_css))
			echo ' style="' . esc_attr($hoverex_css) . '"';
?>><?php
	// Add anchor
	$hoverex_anchor_icon = hoverex_get_theme_option('front_page_features_anchor_icon');	
	$hoverex_anchor_text = hoverex_get_theme_option('front_page_features_anchor_text');	
	if ((!empty($hoverex_anchor_icon) || !empty($hoverex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_features"'
										. (!empty($hoverex_anchor_icon) ? ' icon="'.esc_attr($hoverex_anchor_icon).'"' : '')
										. (!empty($hoverex_anchor_text) ? ' title="'.esc_attr($hoverex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_features_inner<?php
			if (hoverex_get_theme_option('front_page_features_fullheight'))
				echo ' hoverex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$hoverex_css = '';
			$hoverex_bg_mask = hoverex_get_theme_option('front_page_features_bg_mask');
			$hoverex_bg_color = hoverex_get_theme_option('front_page_features_bg_color');
			if (!empty($hoverex_bg_color) && $hoverex_bg_mask > 0)
				$hoverex_css .= 'background-color: '.esc_attr($hoverex_bg_mask==1
																	? $hoverex_bg_color
																	: hoverex_hex2rgba($hoverex_bg_color, $hoverex_bg_mask)
																).';';
			if (!empty($hoverex_css))
				echo ' style="' . esc_attr($hoverex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_features_content_wrap content_wrap">
			<?php
			// Caption
			$hoverex_caption = hoverex_get_theme_option('front_page_features_caption');
			if (!empty($hoverex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_features_caption front_page_block_<?php echo !empty($hoverex_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($hoverex_caption); ?></h2><?php
			}
		
			// Description (text)
			$hoverex_description = hoverex_get_theme_option('front_page_features_description');
			if (!empty($hoverex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_features_description front_page_block_<?php echo !empty($hoverex_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($hoverex_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_features_output"><?php 
				if (is_active_sidebar('front_page_features_widgets')) {
					dynamic_sidebar( 'front_page_features_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!hoverex_exists_trx_addons())
						hoverex_customizer_need_trx_addons_message();
					else
						hoverex_customizer_need_widgets_message('front_page_features_caption', 'ThemeREX Addons - Services');
				}
			?></div>
		</div>
	</div>
</div>