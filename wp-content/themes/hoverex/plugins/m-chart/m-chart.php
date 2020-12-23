<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('hoverex_chart_theme_setup9')) {
	add_action( 'after_setup_theme', 'hoverex_chart_theme_setup9', 9 );
	function hoverex_chart_theme_setup9() {
		if (hoverex_exists_chart()) {

		}
		if (is_admin()) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins',		'hoverex_chart_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_chart_tgmpa_required_plugins' ) ) {
	function hoverex_chart_tgmpa_required_plugins($list=array()) {
		$path = hoverex_get_file_dir('plugins/m-chart/m-chart.zip');
		if (hoverex_storage_isset('required_plugins', 'm-chart')) {
			$list[] = array(
				'name' 		=> hoverex_storage_get_array('required_plugins', 'm-chart'),
				'slug' 		=> 'm-chart',
				'source'	=> !empty($path) ? $path : 'upload://m-chart.zip',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Disable M Chart Highcharts Library plugin updates
function my_filter_plugin_updates( $value ) {
    if( isset( $value->response['m-chart/m-chart.php'] ) ) {
        unset( $value->response['m-chart/m-chart.php'] );
    }
    return $value;
}

add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );

// Check if plugin installed and activated
if ( !function_exists( 'hoverex_exists_chart' ) ) {
	function hoverex_exists_chart() {
		return function_exists('m_chart');
	}
}


?>