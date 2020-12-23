<?php
/**
 * Child-Theme functions and definitions
 */
function hoverex_child_scripts() {
    wp_enqueue_style( 'hoverex-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'hoverex_child_scripts' );

?>