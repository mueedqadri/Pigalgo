<?php
/**
 * The template to display all single pages
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}

get_footer();
?>