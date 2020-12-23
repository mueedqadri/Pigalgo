<?php
/* Give support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('hoverex_give_theme_setup9')) {
	add_action( 'after_setup_theme', 'hoverex_give_theme_setup9', 9 );
	function hoverex_give_theme_setup9() {
		if (hoverex_exists_give()) {

		}
		if (is_admin()) {
			add_filter( 'hoverex_filter_tgmpa_required_plugins',		'hoverex_give_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_give_tgmpa_required_plugins' ) ) {
	function hoverex_give_tgmpa_required_plugins($list=array()) {
		if (hoverex_storage_isset('required_plugins', 'give')) {
			$list[] = array(
				'name' 		=> hoverex_storage_get_array('required_plugins', 'give'),
				'slug' 		=> 'give',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'hoverex_exists_give' ) ) {
	function hoverex_exists_give() {
		return function_exists('m_chart');
	}
}


?>