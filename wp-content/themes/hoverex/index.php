<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */
if ( substr(hoverex_get_theme_option('blog_style'), 0, 7) == 'classic' )
	get_template_part( 'index', 'classic' );
else if ( substr(hoverex_get_theme_option('blog_style'), 0, 7) == 'masonry' )
	get_template_part( 'index', 'classic' );
else if ( substr(hoverex_get_theme_option('blog_style'), 0, 7) == 'gallery' )
	get_template_part( 'index', 'portfolio' );
else if ( substr(hoverex_get_theme_option('blog_style'), 0, 9) == 'portfolio' )
	get_template_part( 'index', 'portfolio' );
else if ( substr(hoverex_get_theme_option('blog_style'), 0, 5) == 'chess' )
	get_template_part( 'index', 'chess' );
else
	get_template_part( 'index', 'excerpt' );
?>