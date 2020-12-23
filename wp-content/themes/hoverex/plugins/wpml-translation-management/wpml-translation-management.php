<?php
/* The WPML Translation Management support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hoverex_wpml_translation_management_feed_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'hoverex_wpml_translation_management_theme_setup9', 9 );
    function hoverex_wpml_translation_management_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_wpml_translation_management_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hoverex_wpml_translation_management_tgmpa_required_plugins' ) ) {
    //Handler of the add_filter('hoverex_filter_tgmpa_required_plugins', 'hoverex_wpml_translation_management_tgmpa_required_plugins');
    function hoverex_wpml_translation_management_tgmpa_required_plugins( $list = array() ) {
        if ( hoverex_storage_isset( 'required_plugins', 'wpml-translation-management' ) ) {
            $path = hoverex_get_file_dir( 'plugins/wpml-translation-management/wpml-translation-management.zip' );
            if ( ! empty( $path ) || hoverex_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => hoverex_storage_get_array( 'required_plugins', 'wpml-translation-management' ),
                    'slug'     => 'wpml-translation-management',
                    'source'   => ! empty( $path ) ? $path : 'upload://wpml-translation-management.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}

// Check if this plugin installed and activated
if ( ! function_exists( 'hoverex_exists_wpml_translation_management' ) ) {
    function hoverex_exists_wpml_translation_management() {
        return defined( 'WPML_TM' );
    }
}
