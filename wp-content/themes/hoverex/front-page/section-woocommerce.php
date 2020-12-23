<div class="front_page_section front_page_section_woocommerce<?php
			$hoverex_scheme = hoverex_get_theme_option('front_page_woocommerce_scheme');
			if (!hoverex_is_inherit($hoverex_scheme)) echo ' scheme_'.esc_attr($hoverex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(hoverex_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$hoverex_css = '';
		$hoverex_bg_image = hoverex_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($hoverex_bg_image)) 
			$hoverex_css .= 'background-image: url('.esc_url(hoverex_get_attachment_url($hoverex_bg_image)).');';
		if (!empty($hoverex_css))
			echo ' style="' . esc_attr($hoverex_css) . '"';
?>><?php
	// Add anchor
	$hoverex_anchor_icon = hoverex_get_theme_option('front_page_woocommerce_anchor_icon');	
	$hoverex_anchor_text = hoverex_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($hoverex_anchor_icon) || !empty($hoverex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($hoverex_anchor_icon) ? ' icon="'.esc_attr($hoverex_anchor_icon).'"' : '')
										. (!empty($hoverex_anchor_text) ? ' title="'.esc_attr($hoverex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (hoverex_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' hoverex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$hoverex_css = '';
			$hoverex_bg_mask = hoverex_get_theme_option('front_page_woocommerce_bg_mask');
			$hoverex_bg_color = hoverex_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($hoverex_bg_color) && $hoverex_bg_mask > 0)
				$hoverex_css .= 'background-color: '.esc_attr($hoverex_bg_mask==1
																	? $hoverex_bg_color
																	: hoverex_hex2rgba($hoverex_bg_color, $hoverex_bg_mask)
																).';';
			if (!empty($hoverex_css))
				echo ' style="' . esc_attr($hoverex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$hoverex_caption = hoverex_get_theme_option('front_page_woocommerce_caption');
			$hoverex_description = hoverex_get_theme_option('front_page_woocommerce_description');
			if (!empty($hoverex_caption) || !empty($hoverex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($hoverex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($hoverex_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($hoverex_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($hoverex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($hoverex_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($hoverex_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$hoverex_woocommerce_sc = hoverex_get_theme_option('front_page_woocommerce_products');
				if ($hoverex_woocommerce_sc == 'products') {
					$hoverex_woocommerce_sc_ids = hoverex_get_theme_option('front_page_woocommerce_products_per_page');
					$hoverex_woocommerce_sc_per_page = count(explode(',', $hoverex_woocommerce_sc_ids));
				} else {
					$hoverex_woocommerce_sc_per_page = max(1, (int) hoverex_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$hoverex_woocommerce_sc_columns = max(1, min($hoverex_woocommerce_sc_per_page, (int) hoverex_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$hoverex_woocommerce_sc}"
									. ($hoverex_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($hoverex_woocommerce_sc_ids).'"' 
											: '')
									. ($hoverex_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(hoverex_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($hoverex_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(hoverex_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(hoverex_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($hoverex_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($hoverex_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>