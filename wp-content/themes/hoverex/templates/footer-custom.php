<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */

$hoverex_footer_id = str_replace('footer-custom-', '', hoverex_get_theme_option("footer_style"));
if ((int) $hoverex_footer_id == 0) {
	$hoverex_footer_id = hoverex_get_post_id(array(
												'name' => $hoverex_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$hoverex_footer_id = apply_filters('hoverex_filter_get_translated_layout', $hoverex_footer_id);
}
$hoverex_footer_meta = get_post_meta($hoverex_footer_id, 'trx_addons_options', true);
if (!empty($hoverex_footer_meta['margin']) != '') 
	hoverex_add_inline_css(sprintf('.page_content_wrap{padding-bottom:%s}', esc_attr(hoverex_prepare_css_value($hoverex_footer_meta['margin']))));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($hoverex_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($hoverex_footer_id))); 
						if (!hoverex_is_inherit(hoverex_get_theme_option('footer_scheme')))
							echo ' scheme_' . esc_attr(hoverex_get_theme_option('footer_scheme'));
						?>">
	<?php
    // Custom footer's layout
    do_action('hoverex_action_show_layout', $hoverex_footer_id);
	?>
</footer><!-- /.footer_wrap -->
