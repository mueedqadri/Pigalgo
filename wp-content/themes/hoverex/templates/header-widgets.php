<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

// Header sidebar
$hoverex_header_name = hoverex_get_theme_option('header_widgets');
$hoverex_header_present = !hoverex_is_off($hoverex_header_name) && is_active_sidebar($hoverex_header_name);
if ($hoverex_header_present) { 
	hoverex_storage_set('current_sidebar', 'header');
	$hoverex_header_wide = hoverex_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($hoverex_header_name) ) {
		dynamic_sidebar($hoverex_header_name);
	}
	$hoverex_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($hoverex_widgets_output)) {
		$hoverex_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $hoverex_widgets_output);
		$hoverex_need_columns = strpos($hoverex_widgets_output, 'columns_wrap')===false;
		if ($hoverex_need_columns) {
			$hoverex_columns = max(0, (int) hoverex_get_theme_option('header_columns'));
			if ($hoverex_columns == 0) $hoverex_columns = min(6, max(1, substr_count($hoverex_widgets_output, '<aside ')));
			if ($hoverex_columns > 1)
				$hoverex_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($hoverex_columns).' widget', $hoverex_widgets_output);
			else
				$hoverex_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($hoverex_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$hoverex_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($hoverex_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'hoverex_action_before_sidebar' );
				hoverex_show_layout($hoverex_widgets_output);
				do_action( 'hoverex_action_after_sidebar' );
				if ($hoverex_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$hoverex_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>