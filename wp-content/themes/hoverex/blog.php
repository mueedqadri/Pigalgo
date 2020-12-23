<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$hoverex_content = '';
$hoverex_blog_archive_mask = '%%CONTENT%%';
$hoverex_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $hoverex_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($hoverex_content = apply_filters('the_content', get_the_content())) != '') {
		if (($hoverex_pos = strpos($hoverex_content, $hoverex_blog_archive_mask)) !== false) {
			$hoverex_content = preg_replace('/(\<p\>\s*)?'.$hoverex_blog_archive_mask.'(\s*\<\/p\>)/i', $hoverex_blog_archive_subst, $hoverex_content);
		} else
			$hoverex_content .= $hoverex_blog_archive_subst;
		$hoverex_content = explode($hoverex_blog_archive_mask, $hoverex_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) hoverex_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$hoverex_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$hoverex_args = hoverex_query_add_posts_and_cats($hoverex_args, '', hoverex_get_theme_option('post_type'), hoverex_get_theme_option('parent_cat'));
$hoverex_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($hoverex_page_number > 1) {
	$hoverex_args['paged'] = $hoverex_page_number;
	$hoverex_args['ignore_sticky_posts'] = true;
}
$hoverex_ppp = hoverex_get_theme_option('posts_per_page');
if ((int) $hoverex_ppp != 0)
	$hoverex_args['posts_per_page'] = (int) $hoverex_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($hoverex_args);


// Add internal query vars in the new query!
if (is_array($hoverex_content) && count($hoverex_content) == 2) {
	set_query_var('blog_archive_start', $hoverex_content[0]);
	set_query_var('blog_archive_end', $hoverex_content[1]);
}

get_template_part('index');
?>