<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */

// Logo
if (hoverex_is_on(hoverex_get_theme_option('logo_in_footer'))) {
	$hoverex_logo_image = '';
	if (hoverex_is_on(hoverex_get_theme_option('logo_retina_enabled')) && hoverex_get_retina_multiplier() > 1)
		$hoverex_logo_image = hoverex_get_theme_option( 'logo_footer_retina' );
	if (empty($hoverex_logo_image)) 
		$hoverex_logo_image = hoverex_get_theme_option( 'logo_footer' );
	$hoverex_logo_text   = get_bloginfo( 'name' );
	if (!empty($hoverex_logo_image) || !empty($hoverex_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($hoverex_logo_image)) {
					$hoverex_attr = hoverex_getimagesize($hoverex_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($hoverex_logo_image).'" class="logo_footer_image" alt="'.$hoverex_logo_text.'"'.(!empty($hoverex_attr[3]) ? ' ' . wp_kses_data($hoverex_attr[3]) : '').'></a>' ;
				} else if (!empty($hoverex_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($hoverex_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>