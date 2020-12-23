<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0
 */

if ( get_query_var('hoverex_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$hoverex_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($hoverex_src[0])) {
		hoverex_sc_layouts_showed('featured', true);
		?><div class="sc_layouts_featured with_image without_content <?php echo esc_attr(hoverex_add_inline_css_class('background-image:url('.esc_url($hoverex_src[0]).');')); ?>"></div><?php
	}
}
?>