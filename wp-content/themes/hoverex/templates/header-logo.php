<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

$hoverex_args = get_query_var('hoverex_logo_args');

// Site logo
$hoverex_logo_type   = isset($hoverex_args['type']) ? $hoverex_args['type'] : '';
$hoverex_logo_image  = hoverex_get_logo_image($hoverex_logo_type);
$hoverex_logo_text   = hoverex_is_on(hoverex_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$hoverex_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($hoverex_logo_image) || !empty($hoverex_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($hoverex_logo_image)) {
			if (empty($hoverex_logo_type) && function_exists('the_custom_logo') && (int) $hoverex_logo_image > 0) {
				the_custom_logo();
			} else {
				$hoverex_attr = hoverex_getimagesize($hoverex_logo_image);
				echo '<img src="'.esc_url($hoverex_logo_image).'" alt="'.esc_attr($hoverex_logo_text).'"'.(!empty($hoverex_attr[3]) ? ' '.wp_kses_data($hoverex_attr[3]) : '').'>';
			}
		} else {
			hoverex_show_layout(hoverex_prepare_macros($hoverex_logo_text), '<span class="logo_text">', '</span>');
			hoverex_show_layout(hoverex_prepare_macros($hoverex_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>