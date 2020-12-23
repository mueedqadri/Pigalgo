<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */

// Footer menu
$hoverex_menu_footer = hoverex_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($hoverex_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php hoverex_show_layout($hoverex_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>