<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('hoverex_gutenberg_theme_setup')) {
    add_action( 'after_setup_theme', 'hoverex_gutenberg_theme_setup', 1 );
    function hoverex_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'hoverex_filter_tgmpa_required_plugins', 'hoverex_gutenberg_tgmpa_required_plugins' );
        }
    }
}

// Check if Gutenberg installed and activated
if ( !function_exists( 'hoverex_exists_gutenberg' ) ) {
    function hoverex_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'hoverex_gutenberg_tgmpa_required_plugins' ) ) {
    function hoverex_gutenberg_tgmpa_required_plugins($list = array()) {
        if (hoverex_storage_isset('required_plugins', 'gutenberg')) {
            $list[] = array(
                'name' => esc_html__('Gutenberg', 'hoverex'),
                'slug' => 'gutenberg',
                'required' => false
            );
            return $list;
        }
    }
}

