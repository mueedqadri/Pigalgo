<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'hoverex_wpml_get_css' ) ) {
	add_filter( 'hoverex_filter_get_css', 'hoverex_wpml_get_css', 10, 2 );
	function hoverex_wpml_get_css( $css, $args ) {
		return $css;
	}
}

