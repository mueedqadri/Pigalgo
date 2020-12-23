<?php
/**
 * Plugin support: Uber Menu
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_ubermenu' ) ) {
	function trx_addons_exists_ubermenu() {
		return class_exists('UberMenu');
	}
}
	

// Return true if theme location assigned to UberMenu
if ( !function_exists( 'trx_addons_ubermenu_check_location' ) ) {
	function trx_addons_ubermenu_check_location($loc) {
		$rez = false;
		if (trx_addons_exists_ubermenu()) {
			$theme_loc = ubermenu_op( 'auto_theme_location', 'main' );
			$rez = !empty($theme_loc[$loc]);
		}
		return $rez;
	}
}


// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_ubermenu_importer_required_plugins' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_ubermenu_importer_required_plugins', 10, 2 );
	function trx_addons_ubermenu_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'ubermenu')!==false && !trx_addons_exists_ubermenu() )
			$not_installed .= '<br>' . esc_html__('UberMenu', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_ubermenu_importer_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_options', 'trx_addons_ubermenu_importer_set_options', 10, 1 );
	function trx_addons_ubermenu_importer_set_options($options=array()) {
		if ( trx_addons_exists_ubermenu() && in_array('ubermenu', $options['required_plugins']) ) {
			$options['additional_options'][]	= 'ubermenu_%';				// Add slugs to export options of this plugin
		}
		return $options;
	}
}
?>