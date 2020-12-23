<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.10
 */

// Footer sidebar
$hoverex_footer_name = hoverex_get_theme_option('footer_widgets');
$hoverex_footer_present = !hoverex_is_off($hoverex_footer_name) && is_active_sidebar($hoverex_footer_name);
if ($hoverex_footer_present) { 
	hoverex_storage_set('current_sidebar', 'footer');
	$hoverex_footer_wide = hoverex_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($hoverex_footer_name) ) {
		dynamic_sidebar($hoverex_footer_name);
	}
	$hoverex_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($hoverex_out)) {
		$hoverex_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $hoverex_out);
		$hoverex_need_columns = true;
		if ($hoverex_need_columns) {
			$hoverex_columns = max(0, (int) hoverex_get_theme_option('footer_columns'));
			if ($hoverex_columns == 0) $hoverex_columns = min(4, max(1, substr_count($hoverex_out, '<aside ')));
			if ($hoverex_columns > 1)
				$hoverex_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($hoverex_columns).' widget', $hoverex_out);
			else
				$hoverex_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($hoverex_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$hoverex_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($hoverex_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'hoverex_action_before_sidebar' );
				hoverex_show_layout($hoverex_out);
				do_action( 'hoverex_action_after_sidebar' );
				if ($hoverex_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$hoverex_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>