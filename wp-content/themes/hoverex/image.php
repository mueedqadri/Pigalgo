<?php
/**
 * The template to display the attachment
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */


get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Parent post navigation.


	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>