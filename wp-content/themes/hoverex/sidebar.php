<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

if (hoverex_sidebar_present()) {
	ob_start();
	$hoverex_sidebar_name = hoverex_get_theme_option('sidebar_widgets');
	hoverex_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($hoverex_sidebar_name) ) {
		dynamic_sidebar($hoverex_sidebar_name);
	}
	$hoverex_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($hoverex_out)) {
		$hoverex_sidebar_position = hoverex_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($hoverex_sidebar_position); ?> widget_area<?php if (!hoverex_is_inherit(hoverex_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(hoverex_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'hoverex_action_before_sidebar' );
				hoverex_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $hoverex_out));
				do_action( 'hoverex_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>