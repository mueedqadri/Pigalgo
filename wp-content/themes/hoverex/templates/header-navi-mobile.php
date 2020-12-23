<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(hoverex_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?>">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('hoverex_logo_args', array('type' => 'mobile'));
		get_template_part( 'templates/header-logo' );
		set_query_var('hoverex_logo_args', array());

		// Mobile menu
		$hoverex_menu_mobile = hoverex_get_nav_menu('menu_mobile');
		if (empty($hoverex_menu_mobile)) {
			$hoverex_menu_mobile = apply_filters('hoverex_filter_get_mobile_menu', '');
			if (empty($hoverex_menu_mobile)) $hoverex_menu_mobile = hoverex_get_nav_menu('menu_main');
			if (empty($hoverex_menu_mobile)) $hoverex_menu_mobile = hoverex_get_nav_menu();
		}
		if (!empty($hoverex_menu_mobile)) {
			if (!empty($hoverex_menu_mobile))
				$hoverex_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$hoverex_menu_mobile
					);
			if (strpos($hoverex_menu_mobile, '<nav ')===false)
				$hoverex_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $hoverex_menu_mobile);
			hoverex_show_layout(apply_filters('hoverex_filter_menu_mobile_layout', $hoverex_menu_mobile));
		}


		
		// Social icons
		hoverex_show_layout(hoverex_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
